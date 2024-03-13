CREATE TABLE partner_user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    partner_id VARCHAR(10) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    middlename VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
);