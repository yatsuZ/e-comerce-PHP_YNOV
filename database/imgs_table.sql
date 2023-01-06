CREATE TABLE imgs(  
    id_img int NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Primary Key',
    id_product INT,
    url VARCHAR(255),
    FOREIGN KEY (id_product) REFERENCES product(id_product)
) COMMENT '';