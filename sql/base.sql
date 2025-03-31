create database i_colab;

use i_colab;
create table
    i_colab_user (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        last_name VARCHAR(100) NOT NULL,
        first_name VARCHAR(100) NOT NULL,
        address TEXT,
        country VARCHAR(50),
        email VARCHAR(100) UNIQUE NOT NULL,
        phone_number VARCHAR(20),
        password VARCHAR(255) NOT NULL,
        profile_picture VARCHAR(255)
    );


insert into i_colab_user (last_name, first_name, address, country, email, phone_number, password)
    values 
    ('Doe', 'John', '123 Main St', 'USA', 'john.doe@example.com', '123-456-7890', 'password123'),
    ('Smith', 'Jane', '456 Elm St', 'Canada', 'jane.smith@example.com', '987-654-3210', 'securepass456'),
    ('Brown', 'Charlie', '789 Oak St', 'UK', 'charlie.brown@example.com', '555-555-5555', 'mypassword789');
   
   
    create table i_colab_colaboration(
        id_publication INT NOT NULL,
        id_user INT NOT NULL,
        PRIMARY KEY (id_publication, id_user)
    );
