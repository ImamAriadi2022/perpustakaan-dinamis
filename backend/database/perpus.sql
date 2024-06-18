-- Tabel roles
CREATE TABLE roles (
    role_id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(50) NOT NULL
);

-- Tabel users
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

-- Tabel books dengan kolom image_url untuk menyimpan URL gambar buku
CREATE TABLE books (
    book_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    publisher VARCHAR(255),
    year INT,
    image_url VARCHAR(255)  -- Kolom untuk URL gambar buku
);

-- Tabel loans
CREATE TABLE loans (
    loan_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    book_id INT,
    loan_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

-- Insert roles
INSERT INTO roles (role_name) VALUES ('admin'), ('peminjam');

-- Insert sample users
INSERT INTO users (username, password, role_id) VALUES 
('admin', 'admin_password', 1), 
('user1', 'user1_password', 2);

-- Insert sample books dengan URL gambar
INSERT INTO books (title, author, publisher, year, image_url) VALUES 
('Book Title 1', 'Author 1', 'Publisher 1', 2020, 'http://example.com/image1.jpg'), 
('Book Title 2', 'Author 2', 'Publisher 2', 2019, 'http://example.com/image2.jpg');



