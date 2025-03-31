function uuidv4() {
  return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (c) {
    const r = (Math.random() * 16) | 0,
      v = c === "x" ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  });
}

// Initialize WebSocket connection
let canvas;
let currentTool = "brush";
let currentColor = "#ff0000";
let isDrawing = false;
let lastSentTimestamp = 0;
const throttleInterval = 50; // milliseconds

// Initialize the canvas once the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Initialize Fabric.js canvas
  canvas = new fabric.Canvas("fabric-canvas", {
    width: window.innerWidth - 450,
    height: window.innerHeight - 120, // Subtract header, toolbar and status bar heights
    backgroundColor: "#ffffff",
    isDrawingMode: true,
  });

  if (canvasJson) {
    canvas.loadFromJSON(canvasJson, () => {
      canvas.renderAll();
    });
  }

  // Update canvas size when window is resized
  window.addEventListener("resize", function () {
    canvas.setWidth(window.innerWidth - 450);
    canvas.setHeight(window.innerHeight - 120);
    canvas.renderAll();
  });

  document.addEventListener("keydown", (e) => {
    // Check if "Delete" or "Backspace" key is pressed
    if (e.code === "Delete" || e.code === "Backspace") {
      const activeObject = canvas.getActiveObject();

      // Delete the selected object
      if (activeObject) {
        canvas.clearing = false;
        canvas.remove(activeObject);
        canvas.renderAll(); // Refresh the canvas
      }
    }
  });

  // Set up initial brush
  canvas.freeDrawingBrush.color = currentColor;
  canvas.freeDrawingBrush.width = 3;

  // Set up tool buttons
  document
    .getElementById("brush-tool")
    .addEventListener("click", () => setTool("brush"));
  document
    .getElementById("select-tool")
    .addEventListener("click", () => setTool("select"));
  document
    .getElementById("rectangle-tool")
    .addEventListener("click", () => setTool("rectangle"));
  document
    .getElementById("circle-tool")
    .addEventListener("click", () => setTool("circle"));
  document
    .getElementById("text-tool")
    .addEventListener("click", () => setTool("text"));
  document
    .getElementById("clear-canvas")
    .addEventListener("click", clearCanvas);

  // Set up color picker
  const colorPicker = document.getElementById("color-picker");
  colorPicker.addEventListener("change", function () {
    currentColor = this.value;
    updateBrushColor();
  });

  // Set up position tracking
  canvas.on("mouse:move", updateCursorPosition);

  // Set up WebSocket event handlers
  setupWebSocketHandlers();

  // Set up object event handlers
  setupCanvasEventHandlers();
});

// Set the current drawing tool
function setTool(tool) {
  // Reset active tool state
  document
    .querySelectorAll(".tool-button")
    .forEach((btn) => btn.classList.remove("active-tool"));
  document.getElementById(`${tool}-tool`).classList.add("active-tool");

  currentTool = tool;

  // Configure canvas based on selected tool
  switch (tool) {
    case "brush":
      canvas.isDrawingMode = true;
      canvas.selection = false;
      break;
    case "select":
      canvas.isDrawingMode = false;
      canvas.selection = true;
      break;
    case "rectangle":
    case "circle":
    case "text":
      canvas.isDrawingMode = false;
      canvas.selection = false;
      canvas.defaultCursor = "crosshair";
      break;
  }
}

// Update the brush color
function updateBrushColor() {
  canvas.freeDrawingBrush.color = currentColor;

  // If an object is selected, update its color
  if (canvas.getActiveObject()) {
    const activeObject = canvas.getActiveObject();
    if (activeObject.stroke) {
      activeObject.set("stroke", currentColor);
    }
    if (activeObject.fill) {
      activeObject.set("fill", currentColor);
    }
    canvas.renderAll();

    // Broadcast the modification
    sendObjectModified(activeObject);
  }
}

// Clear the canvas
function clearCanvas() {
  canvas.clearing = true;
  canvas.clear();
  canvas.backgroundColor = "#ffffff";
  canvas.renderAll();

  // Broadcast canvas clear
  socket.send(
    JSON.stringify({
      type_drawing: "drawing",
      action: "canvas_clear",
      id: currentUserId,
      group_id: currentGroupId,
    })
  );
}

// Update cursor position display
function updateCursorPosition(event) {
  const pointer = canvas.getPointer(event.e);
  document.getElementById(
    "cursor-position"
  ).textContent = `Position: ${Math.round(pointer.x)}, ${Math.round(
    pointer.y
  )}`;
}

// Setup WebSocket event handlers
function setupWebSocketHandlers() {
  socket.onmessage = function (event) {
    const data = JSON.parse(event.data);

    if (data.type === "drawing_update") {
      handleDrawingUpdate(data);
    } else if (data.type === "canvas_state") {
      // Load the entire canvas state
      loadCanvasState(data.canvas_json);
    }
  };
}

// Handle drawing updates from other users
function handleDrawingUpdate(data) {
  switch (data.action) {
    case "object_added":
      addObjectFromJSON(data.data);
      break;

    case "object_modified":
      updateObjectFromJSON(data.data);
      break;

    case "object_removed":
      removeObjectById(data.data.id);
      break;

    case "canvas_clear":
      canvas.clear();
      canvas.backgroundColor = "#ffffff";
      canvas.renderAll();
      break;

    case "canvas_save":
      loadCanvasState(data.data.canvas_json);
      break;
  }
}

// Load a full canvas state from JSON
function loadCanvasState(canvasJSON) {
  canvas.clear();
  canvas.loadFromJSON(canvasJSON, function () {
    canvas.renderAll();
  });
}

// Setup canvas event handlers
function setupCanvasEventHandlers() {
  // Handle object adding
  canvas.on("object:added", function (e) {
    const obj = e.target;
    obj.id = obj.id || uuidv4();

    // Don't send events for objects loaded from saved state
    if (obj.__fromServer || isDrawing) {
      delete obj.__fromServer;
      return;
    }

    sendObjectAdded(obj);
  });

  // Handle object modifications
  canvas.on("object:modified", function (e) {
    sendObjectModified(e.target);
  });

  // Handle object removal
  canvas.on("object:removed", function (e) {
    const obj = e.target;

    if (canvas.clearing) {
      return;
    }

    sendObjectRemoved(obj);
  });

  // Setup mouse down event for shape creation
  canvas.on("mouse:down", function (o) {
    if (currentTool === "rectangle" || currentTool === "circle") {
      isDrawing = true;
      const pointer = canvas.getPointer(o.e);
      const shapeOptions = {
        left: pointer.x,
        top: pointer.y,
        originX: "left",
        originY: "top",
        width: 0,
        height: 0,
        stroke: currentColor,
        strokeWidth: 2,
        fill: "rgba(0,0,0,0)",
        id: uuidv4(),
      };

      if (currentTool === "rectangle") {
        canvas.shape = new fabric.Rect(shapeOptions);
        canvas.shape_type = "rectangle";
      } else if (currentTool === "circle") {
        canvas.shape = new fabric.Ellipse({
          ...shapeOptions,
          rx: 0,
          ry: 0,
        });

        canvas.shape_type = "circle";
      }

      canvas.shape.startPosX = pointer.x;
      canvas.shape.startPosY = pointer.y;

      canvas.add(canvas.shape);
    } else if (currentTool === "text") {
      const pointer = canvas.getPointer(o.e);
      const text = new fabric.IText("Text", {
        left: pointer.x,
        top: pointer.y,
        fill: currentColor,
        fontFamily: "Arial",
        fontSize: 20,
        editable: true,
      });

      canvas.add(text);
      canvas.setActiveObject(text);
      text.enterEditing();
      setTool("select"); // Switch to select tool after adding text
    }
  });

  // Setup mouse move event for shape creation
  canvas.on("mouse:move", function (o) {
    if (!isDrawing) return;

    const pointer = canvas.getPointer(o.e);

    if (currentTool === "rectangle") {
      if (pointer.x > canvas.shape.left) {
        canvas.shape.set({ width: pointer.x - canvas.shape.left });
      }
      if (pointer.y > canvas.shape.top) {
        canvas.shape.set({ height: pointer.y - canvas.shape.top });
      }

      canvas.renderAll();
    } else if (currentTool === "circle") {
      const rx = Math.abs(pointer.x - canvas.shape.left) / 2;
      const ry = Math.abs(pointer.y - canvas.shape.top) / 2;

      if (rx > 0) canvas.shape.set({ rx: rx });
      if (ry > 0) canvas.shape.set({ ry: ry });

      canvas.shape.set({
        left:
          pointer.x > canvas.shape.startPosX
            ? canvas.shape.startPosX
            : pointer.x,
        top:
          pointer.y > canvas.shape.startPosY
            ? canvas.shape.startPosY
            : pointer.y,
      });

      canvas.renderAll();
    }
  });

  // Setup mouse up event for shape creation
  canvas.on("mouse:up", function () {
    if (isDrawing) {
      isDrawing = false;
      sendObjectAdded(canvas.shape);
      canvas.setActiveObject(null);
      canvas.shape = null;
    }
  });
}

// Send object added event to the server
function sendObjectAdded(obj) {
  // Throttle the events to avoid overwhelming the server
  const now = Date.now();
  if (now - lastSentTimestamp < throttleInterval) return;
  lastSentTimestamp = now;

  const objJSON = obj.toJSON(["id"]);
  socket.send(
    JSON.stringify({
      type_drawing: "drawing",
      action: "object_added",
      object: objJSON,
      id: currentUserId,
      objectId: obj.id,
      group_id: currentGroupId,
    })
  );
}

// Send object modified event to the server
function sendObjectModified(obj) {
  const objJSON = obj.toJSON(["id"]);
  socket.send(
    JSON.stringify({
      type_drawing: "drawing",
      action: "object_modified",
      object: objJSON,
      objectId: obj.id,
      id: currentUserId,
      group_id: currentGroupId,
    })
  );
}

// Send object removed event to the server
function sendObjectRemoved(obj) {
  socket.send(
    JSON.stringify({
      type_drawing: "drawing",
      action: "object_removed",
      objectId: obj.id,
      id: currentUserId,
      group_id: currentGroupId,
    })
  );
}

// Add an object from JSON data
function addObjectFromJSON(objectData) {
  fabric.util.enlivenObjects([objectData], function (objects) {
    objects.forEach((obj) => {
      obj.__fromServer = true;
      obj.id = objectData.id; // Set the ID from the JSON data
      canvas.add(obj);
    });
    canvas.renderAll();
  });
}

// Update an existing object from JSON data
function updateObjectFromJSON(objectData) {
  const existingObject = findObjectById(objectData.id);

  if (existingObject) {
    delete objectData.objects; // Remove any group objects to prevent duplicates
    existingObject.set(objectData);
    canvas.renderAll();
  } else {
    // If the object doesn't exist, create it
    addObjectFromJSON(objectData);
  }
}

// Remove an object by ID
function removeObjectById(id) {
  const obj = findObjectById(id);
  if (obj) {
    canvas.clearing = true; // Flag to prevent triggering object:removed event
    canvas.remove(obj);
    canvas.clearing = false;
    canvas.renderAll();
  }
}

// Find an object by ID
function findObjectById(id) {
  let objects = canvas.getObjects();
  for (let i = 0; i < objects.length; i++) {
    if (objects[i].id === id) {
      return objects[i];
    }
  }
  return null;
}

// Save current canvas state
function saveCanvas() {
  const canvasJSON = JSON.stringify(canvas.toJSON(["id"]));

  socket.send(
    JSON.stringify({
      type_drawing: "drawing",
      action: "canvas_save",
      canvas_json: canvasJSON,
      id: currentUserId,
      group_id: currentGroupId,
    })
  );
}

// Function to set current user and group IDs
function setUserAndGroup(userId, groupId) {
  currentUserId = userId;
  currentGroupId = groupId;

  // If socket is already open, send the connect message
  if (socket.readyState === WebSocket.OPEN) {
    socket.send(
      JSON.stringify({
        type: "connect",
        id: currentUserId,
        group_id: currentGroupId,
      })
    );
  }
}

// Add a share functionality to the share button
document.addEventListener("DOMContentLoaded", function () {
  const saveButton = document.querySelector(".header-actions .tool-button");

  const showModal = () => {
    alert("Canvas Saved");
  };

  saveButton.addEventListener("click", function () {
    showModal();
    saveCanvas();
  });

  setInterval(() => {
    saveCanvas();
  }, 5000);

  document.addEventListener("keydown", function (e) {
    if (
      e.ctrlKey &&
      e.key === "s" &&
      socket &&
      socket.readyState === WebSocket.OPEN
    ) {
      showModal();
      e.preventDefault();
      saveCanvas();
    }
  });
});
