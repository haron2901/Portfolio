СОЗДАЙТЕ БД С НАЗВАНИЕМ php И ВПИШИТЕ ТУДА ЭТОТ SQL ЗАПРОС

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL,
  discountPercentage DECIMAL(5, 2),
  rating INT,
  stock INT,
  brand VARCHAR(255),
  category VARCHAR(255),
  thumbnail VARCHAR(255)
);
