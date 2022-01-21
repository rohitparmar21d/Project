-- schema created
CREATE SCHEMA helperland;

-- table of Customer's Details
CREATE TABLE helperland.Customer
(
  Customer_ID INT PRIMARY KEY AUTO_INCREMENT,
  Fisrt_Name VARCHAR(150) NOT NULL,
  Last_Name VARCHAR(150) NOT NULL,
  Email_ID VARCHAR(100) NOT NULL,
  Mobile_Number INT NOT NULL,
  Language VARCHAR(100) ,
  Birthdate DATE,
  Password VARCHAR(100) NOT NULL,
  Registration_Date DATE NOT NULL
  );

-- table of Admins' Details
CREATE TABLE helperland.Admins
(
  Admin_ID INT PRIMARY KEY AUTO_INCREMENT,
  Fisrt_Name VARCHAR(150) NOT NULL,
  Last_Name VARCHAR(150) NOT NULL,
  Email_ID VARCHAR(100) NOT NULL,
  Password VARCHAR(100) NOT NULL
  );
  
-- table of Avatars of Service providers
CREATE TABLE helperland.Avatars
(
  Avatar_ID INT PRIMARY KEY AUTO_INCREMENT,
  Avatar_img VARBINARY(150) NOT NULL
);

-- table of Service privider's details

CREATE TABLE helperland.Service_Provider
(
  SP_ID INT PRIMARY KEY AUTO_INCREMENT,
  Fisrt_Name VARCHAR(150) NOT NULL,
  Last_Name VARCHAR(150) NOT NULL,
  Email_ID VARCHAR(100) NOT NULL,
  Mobile_Number INT NOT NULL,
  Language VARCHAR(100) ,
  Birthdate DATE,
  Password VARCHAR(100) NOT NULL,
  Nationality VARCHAR(20) NOT NULL,
  Gender VARCHAR(10) NOT NULL,
  Address VARCHAR(255) NOT NULL,
  Zipcode INT NOT NULL,
  Avatar_ID INT NOT NULL,
  Rating INT NOT NULL,
  CHECK (Rating>=0 AND Rating<=5),
  Registration_Date DATE NOT NULL,
  Foreign key (Avatar_ID) references Avatars(Avatar_ID)
  );

-- table of customer's Addresses

CREATE TABLE helperland.Customer_Addresses
(
  Add_ID INT PRIMARY KEY AUTO_INCREMENT,
  Customer_ID INT NOT NULL,
  House_No INT ,
  Street_Name VARCHAR(100) NOT NULL,
  City VARCHAR(50) NOT NULL,
  postalcode INT NOT NULL,
  Foreign key (Customer_ID) references Customer(Customer_ID)
  );
  
-- table od service status

CREATE TABLE helperland.Service_status
(
  Servive_status_ID INT PRIMARY KEY AUTO_INCREMENT,
  Servive_status_Name VARCHAR(15) NOT NULL
);  

-- table of  payment_status

CREATE TABLE helperland.Payment_status
(
  Payment_status_ID INT PRIMARY KEY AUTO_INCREMENT,
  Payment_status_Name VARCHAR(15) NOT NULL
);  

-- table for service details

CREATE TABLE helperland.Service_Details
(
  Service_ID INT PRIMARY KEY AUTO_INCREMENT,
  Service_Date DATE NOT NULL,
  Service_Time TIME NOT NULL,
  Service_Hours INT NOT NULL,
  Add_ID INT NOT NULL,
  Servive_status_ID INT NOT NULL,
  Customer_ID INT NOT NULL,
  SP_ID INT NOT NULL,
  Payment_amount INT NOT NULL,
  Payment_status_ID INT NOT NULL,
  Foreign key (Add_ID) references Customer_Addresses(Add_ID),
  Foreign key (Servive_status_ID) references Service_status(Servive_status_ID),
  Foreign key (Customer_ID) references Customer(Customer_ID),
  Foreign key (SP_ID) references Service_Provider(SP_ID),
  Foreign key (Payment_status_ID) references Payment_status(Payment_status_ID)
);



