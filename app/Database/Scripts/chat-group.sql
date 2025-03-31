-- Group table to store chat groups
CREATE TABLE `Group` (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    admin_id INT NOT NULL
);

-- Junction table for group members (many-to-many relationship)
CREATE TABLE GroupMember (
    group_id INT NOT NULL,
    user_id INT NOT NULL,
    role ENUM('admin', 'member') DEFAULT 'member',
    joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Message table to store chat messages
CREATE TABLE Message (
    id INT PRIMARY KEY AUTO_INCREMENT,
    group_id INT NOT NULL,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reply_to INT
);

CREATE INDEX idx_group_member ON GroupMember(group_id, user_id);
CREATE INDEX idx_message_group ON Message(group_id);
CREATE INDEX idx_message_timestamp ON Message(timestamp);