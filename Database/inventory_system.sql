/*Final IMS db script*/

CREATE TABLE Category (
    cat_id CHAR(50) ,
    cat_name VARCHAR(200),
	CONSTRAINT Category_PK PRIMARY KEY(cat_id)
);

CREATE TABLE Products (
    pro_id CHAR(50),
    pro_name VARCHAR(200),
    categorie_id CHAR(50),
    media_file VARCHAR(255),
    created DATE,
	CONSTRAINT Products_PK PRIMARY KEY(pro_id),
    CONSTRAINT Products_categorie_id_FK FOREIGN KEY(categorie_id) REFERENCES Category(cat_id)
);

CREATE TABLE Stocks (
    s_id CHAR(50),
    pro_id CHAR(50),
    batch_no VARCHAR(100),
    quantity INT,
    buy_price VARCHAR(200),
    sale_price VARCHAR(200),
    s_alert CHAR(50),
    add_date DATE,
    CONSTRAINT Stocks_PK PRIMARY KEY(s_id),
	CONSTRAINT Stocks_pro_id_FK FOREIGN KEY(pro_id) REFERENCES Products(pro_id)
);

CREATE TABLE Sales (
    sales_id CHAR(50),
    stock_id CHAR(50),
    qty INT,
    price VARCHAR(200),
    date DATE,
    CONSTRAINT Sales_PK PRIMARY KEY(sales_id),
	CONSTRAINT Sales_stock_id_FK FOREIGN KEY(stock_id) REFERENCES Stocks(s_id)
);

CREATE TABLE Users (
    id CHAR(50),
    name VARCHAR(200),
    username VARCHAR(200),
    password VARCHAR(255),
    status VARCHAR(100),
    last_login DATETIME,
	CONSTRAINT Users_PK PRIMARY KEY(id)
);