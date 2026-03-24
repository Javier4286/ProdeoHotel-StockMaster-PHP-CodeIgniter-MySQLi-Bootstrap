drop DATABASE if EXISTS prodeo;
create database prodeo;
use prodeo;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT 0,
    active BOOLEAN NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    INDEX idx_user_active_email (active , email)
);

CREATE TABLE IF NOT EXISTS categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(150) UNIQUE NOT NULL,
    description VARCHAR(300) NOT NULL,
    quantity INT NOT NULL DEFAULT 0,
    min_stock INT NOT NULL DEFAULT 5,
    price DECIMAL(10 , 2 ) NOT NULL DEFAULT 0.00,
    id_category INT NOT NULL,
    active BOOL NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT chk_prod_description CHECK (CHAR_LENGTH(TRIM(description)) >= 20),
    CONSTRAINT chk_prod_quantity CHECK (quantity >= 0),
    CONSTRAINT chk_prod_min_stock CHECK (min_stock >= 0),
    CONSTRAINT chk_prod_price CHECK (price >= 0),
    FOREIGN KEY (id_category)
        REFERENCES categories (id)
        ON DELETE RESTRICT,
    INDEX idx_product_category (id_category),
    INDEX idx_product_active (active)
);

CREATE TABLE IF NOT EXISTS transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    quantity INT NOT NULL,
    movement ENUM('in', 'out') NOT NULL,
    id_user INT NOT NULL,
    id_product INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_trans_quantity CHECK (quantity > 0),
    FOREIGN KEY (id_user)
        REFERENCES users (id),
    FOREIGN KEY (id_product)
        REFERENCES products (id),
    INDEX idx_trans_created (created_at),
    INDEX idx_trans_user (id_user),
    INDEX idx_trans_product (id_product)
);

INSERT INTO users (first_name, last_name, email, password, address, phone, is_admin) 
VALUES ("Genesis", "Vargas", "admin@prodeohotel.com", "$2y$10$6kU/bHmofboebFV14THojOI3etI2GO7QWlaDYC.xcrvKBEYR.skZK", "Gorriti 5374", "+5491148314471", 1);

INSERT INTO users (first_name, last_name, email, password, address, phone, is_admin) 
VALUES ("Valeska", "Grillo", "staff@prodeohotel.com", "$2y$10$6kU/bHmofboebFV14THojOI3etI2GO7QWlaDYC.xcrvKBEYR.skZK", "Gorriti 5374", "+5491148314471", 0);

INSERT INTO users (first_name, last_name, email, password, address, phone, is_admin) 
VALUES ("Jesús", "Hurtado", "aa&bb@prodeohotel.com", "$2y$10$6kU/bHmofboebFV14THojOI3etI2GO7QWlaDYC.xcrvKBEYR.skZK", "Gorriti 5374", "+5491148314471", 0);

INSERT INTO categories (name) VALUES ('Housekeeping'), ('Food & Beverage'), ('Office Supplies'), ('Toiletries'), ('Maintenance');

INSERT INTO products (name, description, quantity, min_stock, price, id_category) VALUES

('Toilet Paper Roll', 'Soft 2-ply toilet paper rolls for guest bathrooms', 500, 100, 150.00, 1),

('Broom Heavy Duty', 'Industrial strength broom for lobby and hallway cleaning', 10, 5, 1200.00, 1),

('Microfiber Cloth', 'Blue microfiber cleaning cloths for dusting surfaces', 100, 20, 85.50, 1),

('Floor Cleaner 5L', 'Lemon scented concentrated liquid for marble floors', 20, 5, 2500.00, 1),

('Glass Cleaner 1L', 'Professional spray for mirrors and windows streak-free', 30, 10, 650.00, 1),

('Laundry Detergent', 'High efficiency powdered soap for hotel linens and towels', 15, 4, 3200.00, 1),

('Mineral Water 500ml', 'Still mineral water bottle for room minibar service', 240, 48, 200.00, 2),

('Espresso Capsules', 'Dark roast coffee capsules for guest room machines', 1000, 200, 120.00, 2),

('Earl Grey Tea Box', 'Premium black tea bags with bergamot for breakfast', 50, 10, 850.00, 2),

('Orange Juice 1L', 'Pasteurized orange juice for the morning buffet service', 40, 12, 1100.00, 2),

('Sugar Sachets 5g', 'White sugar individual portions for coffee and tea', 2000, 500, 5.00, 2),

('Paper Napkins Box', 'White disposable napkins for restaurant and room service', 100, 25, 450.00, 2),

('Ballpoint Pen Blue', 'Retractable blue ink pens with hotel logo for desks', 200, 50, 180.00, 3),

('A4 Paper Ream', 'High quality 80g white paper for reception printing', 50, 10, 5500.00, 3),

('Stapler Metal', 'Desktop stapler for administrative office and reception', 5, 2, 1500.00, 3),

('Paper Clips Box', 'Small metal paper clips for document organization', 20, 5, 350.00, 3),

('Sticky Notes Yellow', 'Square yellow self-adhesive notes for quick reminders', 40, 10, 600.00, 3),

('Manila Envelopes', 'Large size envelopes for guest mail and internal documents', 100, 20, 95.00, 3),

('Mini Shampoo Bottle', 'Aloe vera nourishing shampoo for guest amenity kits', 600, 100, 95.00, 4),

('Miniature Soap Bar', 'Vegetal based hand soap with light floral fragrance', 800, 150, 75.00, 4),

('Shower Gel 30ml', 'Revitalizing body wash for executive room bathrooms', 500, 100, 110.00, 4),

('Dental Kit Pro', 'Disposable toothbrush and small toothpaste travel set', 200, 50, 350.00, 4),

('Shaving Kit Set', 'Single use razor and shaving cream for guest convenience', 150, 40, 420.00, 4),

('Shower Cap Plastic', 'Transparent plastic shower caps in individual boxes', 400, 100, 45.00, 4),

('LED Bulb 9W', 'Warm white LED bulbs for bedside and desk lamps', 60, 15, 850.00, 5),

('Alkaline Battery AA', 'Long lasting batteries for remote controls and clocks', 120, 24, 450.00, 5),

('Duct Tape Silver', 'Strong adhesive tape for temporary repairs and fixes', 12, 4, 1800.00, 5),

('Multi-purpose Oil', 'Lubricant spray for door hinges and trolley wheels', 8, 3, 2100.00, 5),

('Universal Adapter', 'Electrical plug adapter for international guest devices', 25, 10, 3500.00, 5),

('Padlock Brass 40mm', 'Security padlock for locker rooms and storage areas', 10, 5, 2800.00, 5);