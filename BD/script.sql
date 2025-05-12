-- =============================
-- ESTRUCTURA DE BASE DE DATOS
-- =============================


-- Tabla de roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    puede_leer BOOLEAN DEFAULT FALSE,
    puede_escribir BOOLEAN DEFAULT FALSE,
    puede_crear BOOLEAN DEFAULT FALSE,
    puede_borrar BOOLEAN DEFAULT FALSE,
    puede_gestionar_roles BOOLEAN DEFAULT FALSE
);

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol_id INT,
    FOREIGN KEY (rol_id) REFERENCES roles(id) ON DELETE SET NULL
);
-- 3. Inserción de roles iniciales
INSERT INTO roles (nombre, puede_leer, puede_escribir, puede_crear, puede_borrar, puede_gestionar_roles)
VALUES 
    ('admin', TRUE, TRUE, TRUE, TRUE, TRUE),
    ('usuario', TRUE, FALSE, FALSE, FALSE, FALSE),
    ('vendedor', TRUE, TRUE, TRUE, FALSE, FALSE);
