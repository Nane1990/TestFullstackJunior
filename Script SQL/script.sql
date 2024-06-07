--Escribe una consulta SQL para crear una base de datos llamada company y una tabla llamada employees
CREATE DATABASE company;
USE company;
CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  position VARCHAR(50) NOT NULL,
  salary DECIMAL(10, 2) NOT NULL,
  hire_date DATE NOT NULL
);

--Escribe una consulta SQL para insertar tres registros en la tabla employees
INSERT INTO employees (name, position, salary, hire_date) VALUES
  ('Nane La O', 'Software Engineer', 60000.00, '2023-01-15'),
  ('Alex Rubio', 'Project Manager', 75000.00, '2022-05-20'),
  ('Dylan Rubio', 'Data Analyst', 55000.00, '2023-03-08');
  
--Muestra cómo actualizar el salario de un empleado específico en la tabla employees
UPDATE employees SET salary = 60000.00 WHERE id = 1;

--Consulta SQL para seleccionar todos los empleados cuyo salario sea mayor a 50000.00 y ordenarlos por el campo hire_date en orden descendente
SELECT * FROM employees WHERE salary > 50000.00 ORDER BY hire_date DESC;

--Crea una vista en MySQL llamada high_earning_employees que seleccione todas las columnas de los empleados cuyo salario sea mayor a 70000.00
CREATE VIEW high_earning_employees AS SELECT * FROM employees 
WHERE salary > 70000.00;