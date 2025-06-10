DROP TABLE IF EXISTS contact_forms;
DROP TABLE IF EXISTS users;


CREATE TABLE contact_forms (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               name VARCHAR(255) NOT NULL,
                               email VARCHAR(255) NOT NULL,
                               message TEXT NOT NULL,
                               created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       email VARCHAR(255) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       nonce VARCHAR(255),
                       nonce_expiry DATETIME,
                       modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                       created DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


--strong_password
INSERT INTO users (email, password, nonce, nonce_expiry, created, modified)
VALUES
    ('john.doe@admin.com', '$2y$10$FHPa1g2W1XGd1XDIr2OkeebWAq6gdohALSfTWTfDptldB85ejxSTy', 'abc123', '2025-02-28 12:00:00', NOW(), NOW());



INSERT INTO contact_forms (name, email, message, created)
VALUES
    ('Alice Johnson', 'alice.johnson@example.com', 'I am interested in your services. Can you provide more details?', NOW()),
    ('Bob Smith', 'bob.smith@example.com', 'Hello, I am facing an issue with my account. Please assist.', NOW()),
    ('Charlie Brown', 'charlie.brown@example.com', 'I would like to schedule a demo of your software. Please let me know the available times.', NOW()),
    ('Diana Prince', 'diana.prince@example.com', 'Can you help me troubleshoot an error I encountered while using your application?', NOW()),
    ('Eve White', 'eve.white@example.com', 'I am interested in learning more about your subscription plans and pricing.', NOW()),
    ('Frank Harris', 'frank.harris@example.com', 'I think I might have been charged incorrectly. Can you assist with that?', NOW()),
    ('Grace Lee', 'grace.lee@example.com', 'I am looking for recommendations for the best features to use in your service. Can you guide me?', NOW()),
    ('Henry Clark', 'henry.clark@example.com', 'How do I update my profile information on your website? I am unable to find the option.', NOW());

