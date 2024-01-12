-- CREATE DATABASE
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+01:00";
CREATE DATABASE IF NOT EXISTS car_show_db;
USE car_show_db;

-- ADMINS
DROP TABLE IF EXISTS admins;
CREATE TABLE IF NOT EXISTS admins (
    adminid INT PRIMARY KEY AUTO_INCREMENT,
    adminname VARCHAR(50),
    pswd VARCHAR(50)
);

INSERT INTO admins (adminname, pswd) VALUES
("admin", "admin"),
("kenniche", "mypass");

-- USERS
-- DROP TABLE IF EXISTS users;
CREATE TABLE IF NOT EXISTS users (
    userid INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    sex VARCHAR(10),
    birthdate VARCHAR(50),
    status VARCHAR(20), -- blocked vs non-blocked
    email VARCHAR(50),
    pswd VARCHAR(50)
);

INSERT INTO users (firstname, lastname, sex, birthdate, status, email, pswd) VALUES
("AbdErrazak", "KENNICHE", "Male", "1988-09-20", "non-blocked", "abderrazak.kenniche@domain.com", "passme"),
("Hicham", "TIHAMI", "Male", "1992-04-15", "non-blocked", "hicham.tihami@domain.com", "pass456arabic"),
("Mohammed", "GUERFI", "Male", "1985-11-10", "non-blocked", "mohammed.guerfi@domain.com", "secureArabicPass789"),
("Anis", "BELHADEF", "Male", "1996-07-05", "non-blocked", "anis.belhadef@domain.com", "1234abcarabic"),
("Aicha", "DERRAZ", "Female", "1990-02-18", "non-blocked", "ahmed.derraz@domain.com", "arabicqwerty567");

-- MARKS
-- DROP TABLE IF EXISTS marks;
CREATE TABLE IF NOT EXISTS marks (
    markid INT PRIMARY KEY AUTO_INCREMENT,
    markname VARCHAR(50),
    country VARCHAR(50),
    headoffice VARCHAR(50),
    foundyear VARCHAR(4),
    logo VARCHAR(50)
);

INSERT INTO marks (markname, country, headoffice, foundyear, logo) VALUES
("Toyota", "Japan", "Toyota City, Aichi", "1937", "toyota.png"),
("BMW", "Germany", "Munich", "1916", "bmw.png"),
("Tesla", "United States", "Palo Alto, California", "2003", "tesla.png"),
("Audi", "Germany", "Ingolstadt", "1909", "audi.png"),
("Ford", "United States", "Dearborn, Michigan", "1903", "ford.png"),
("Wolkswagen", "Germany", "Wolfsburg", "1937", "wolkswagen.png");

-- CARS
-- DROP TABLE IF EXISTS cars;
CREATE TABLE IF NOT EXISTS cars (
    carid INT PRIMARY KEY AUTO_INCREMENT,
    carname VARCHAR(50),
    carimage VARCHAR(50),
    cardescription VARCHAR(50),
    carversion INT,
    caryear VARCHAR(4),
    markid INT,
    rate INT DEFAULT 0,
    FOREIGN KEY (markid) REFERENCES marks(markid) 
);


-- Toyota
INSERT INTO cars (carname, carimage, cardescription, carversion, caryear, markid, rate) VALUES
("Camry SE",  "Camry SE.jpg", "Midsize Sedan", 2022, "2022", 1, 0),
("Corolla LE", "Corolla LE.jpg", "Compact Sedan", 2022, "2022", 1, 0),
("Rav4 XLE", "Rav4 XLE.jpg", "Compact SUV", 2022, "2022", 1, 0),
("Corolla XSE", "Corolla XSE.jpg", "Compact Sedan", 2024, "2024", 1, 0),

-- BMW
("3 Series M340i", "3 Series M340i.jpg", "Luxury Sedan", 2022, "2022", 2, 0),
("5 Series 530i", "5 Series 530i.jpg", "Midsize Luxury Sedan", 2022, "2022", 2, 0),
("BMW X3 xDrive30i", "BMW X3 xDrive30i.jpg", "Compact SUV", 2024, "2024", 2, 0),

-- Tesla
("Model S Long Range", "Model S Long Range.jpg", "Electric Sedan", 2022, "2022", 3, 0),
("Model 3 Standard Range Plus", "Model 3 Standard Range Plus.jpg", "Electric Sedan", 2022, "2022", 3, 0),

-- Audi
("A3 Premium", "A3 Premium.jpg", "Compact Sedan", 2022, "2022", 4, 0),
("A4 Premium Plus", "A4 Premium Plus.jpg", "Midsize Sedan", 2022, "2022", 4, 0),

-- Ford
("Mustang GT", "Mustang GT.jpg", "Sports Car", 2022, "2022", 5, 0),
("F-150 XLT", "F-150 XLT.jpg", "Full-Size Pickup Truck", 2022, "2022", 5, 0),

-- Volkswagen
("Golf GTI", "Golf GTI.jpg", "Hatchback", 2024, "2024", 6, 0),

-- Others
("Tesla Model Y Long Range", "Tesla Model Y Long Range.jpg", "Electric SUV", 2022, "2022", 3, 0),
("Audi Q5 Premium", "Audi Q5 Premium.jpg", "Midsize SUV", 2023, "2023", 4, 0),
("Ford Explorer XLT", "Ford Explorer XLT.jpg", "Midsize SUV", 2022, "2022", 5, 0),
("Wolkswagen Tiguan SEL", "Wolkswagen Tiguan SEL.jpg", "Compact SUV", 2022, "2022", 6, 0);


-- FAVORITE-CARS
-- DROP TABLE IF EXISTS favorite_cars;
CREATE TABLE IF NOT EXISTS favorite_cars (
    carid INT,
    userid INT,
    FOREIGN KEY (carid) REFERENCES cars(carid),
    FOREIGN KEY (userid) REFERENCES users(userid)
);

-- FEATURES
-- DROP TABLE IF EXISTS features;
CREATE TABLE IF NOT EXISTS features (
    featureid INT PRIMARY KEY AUTO_INCREMENT,
    featureunit VARCHAR(20) DEFAULT "",
    featurename VARCHAR(50)
);

INSERT INTO features (featurename) VALUES
("color"),
("number_seets"),
("speed"),
("motor"),
("Fuel Type"),
("Max Power"),
("Mileage"),
("Boot Space"),
("Transmission"),
("Ground Clearness"),
("Airbags"),
("NCAP rating");

-- CARS-FEATURES
CREATE TABLE carsfeatures (
    carid INT,
    featureid INT,
    featureval VARCHAR(200),
    FOREIGN KEY (carid) REFERENCES cars(carid),
    FOREIGN KEY (featureid) REFERENCES features(featureid)
);

-- Toyota Camry SE
INSERT INTO carsfeatures (carid, featureid, featureval) VALUES
(1, 1, "Blue"), -- Color
(1, 2, "5"), -- Number of Seats
(1, 3, "180"), -- Speed
(1, 4, "2.5L 4-cylinder"), -- Motor
(1, 5, "Petrol"), -- Fuel Type
(1, 6, "206 hp"), -- Max Power
(1, 7, "29 MPG"), -- Mileage
(1, 8, "15.1 cubic feet"), -- Boot Space
(1, 9, "8-speed automatic"), -- Transmission
(1, 10, "6.7 inches"), -- Ground Clearance
(1, 11, "10"), -- Airbags
(1, 12, "5-star"), -- NCAP rating

(2, 1, "Silver"), -- Color
(2, 2, "5"), -- Number of Seats
(2, 3, "150"), -- Speed
(2, 4, "1.8L 4-cylinder"), -- Motor
(2, 5, "Petrol"), -- Fuel Type
(2, 6, "139 hp"), -- Max Power
(2, 7, "33 MPG"), -- Mileage
(2, 8, "13.1 cubic feet"), -- Boot Space
(2, 9, "Continuously Variable Transmission (CVT)"), -- Transmission
(2, 10, "5.1 inches"), -- Ground Clearance
(2, 11, "8"), -- Airbags
(2, 12, "5-star"), -- NCAP rating

-- Toyota Rav4 XLE
(3, 1, "Blue"), -- Color
(3, 2, "5"), -- Number of Seats
(3, 3, "130"), -- Speed
(3, 4, "2.5L 4-cylinder"), -- Motor
(3, 5, "Petrol"), -- Fuel Type
(3, 6, "203 hp"), -- Max Power
(3, 7, "28 MPG"), -- Mileage
(3, 8, "37.5 cubic feet"), -- Boot Space
(3, 9, "8-speed automatic"), -- Transmission
(3, 10, "8.4 inches"), -- Ground Clearance
(3, 11, "8"), -- Airbags
(3, 12, "5-star"), -- NCAP rating

-- Toyota Corolla XSE
(4, 1, "Black"), -- Color
(4, 2, "5"), -- Number of Seats
(4, 3, "155"), -- Speed
(4, 4, "2.0L 4-cylinder"), -- Motor
(4, 5, "Petrol"), -- Fuel Type
(4, 6, "169 hp"), -- Max Power
(4, 7, "31 MPG"), -- Mileage
(4, 8, "13.1 cubic feet"), -- Boot Space
(4, 9, "Continuously Variable Transmission (CVT)"), -- Transmission
(4, 10, "5.1 inches"), -- Ground Clearance
(4, 11, "8"), -- Airbags
(4, 12, "5-star"), -- NCAP rating

-- BMW 3 Series M340i
(5, 1, "Black"), -- Color
(5, 2, "5"), -- Number of Seats
(5, 3, "250"), -- Speed
(5, 4, "3.0L 6-cylinder"), -- Motor
(5, 5, "Petrol"), -- Fuel Type
(5, 6, "382 hp"), -- Max Power
(5, 7, "26 MPG"), -- Mileage
(5, 8, "13 cubic feet"), -- Boot Space
(5, 9, "8-speed automatic"), -- Transmission
(5, 10, "5.7 inches"), -- Ground Clearance
(5, 11, "6"), -- Airbags
(5, 12, "5-star"), -- NCAP rating

-- BMW 5 Series 530i
(6, 1, "White"), -- Color
(6, 2, "5"), -- Number of Seats
(6, 3, "146"), -- Speed
(6, 4, "2.0L 4-cylinder"), -- Motor
(6, 5, "Petrol"), -- Fuel Type
(6, 6, "248 hp"), -- Max Power
(6, 7, "32 MPG"), -- Mileage
(6, 8, "14 cubic feet"), -- Boot Space
(6, 9, "8-speed automatic"), -- Transmission
(6, 10, "5.7 inches"), -- Ground Clearance
(6, 11, "6"), -- Airbags
(6, 12, "5-star"), -- NCAP rating

-- BMW X3 xDrive30i
(7, 1, "Silver"), -- Color
(7, 2, "5"), -- Number of Seats
(7, 3, "135"), -- Speed
(7, 4, "2.0L 4-cylinder"), -- Motor
(7, 5, "Petrol"), -- Fuel Type
(7, 6, "248 hp"), -- Max Power
(7, 7, "29 MPG"), -- Mileage
(7, 8, "28.7 cubic feet"), -- Boot Space
(7, 9, "8-speed automatic"), -- Transmission
(7, 10, "8 inches"), -- Ground Clearance
(7, 11, "6"), -- Airbags
(7, 12, "5-star"), -- NCAP rating

(8, 1, "Red"), -- Color
(8, 2, "5"), -- Number of Seats
(8, 3, "155"), -- Speed
(8, 4, "2.0L 4-cylinder"), -- Motor
(8, 5, "Petrol"), -- Fuel Type
(8, 6, "241 hp"), -- Max Power
(8, 7, "28 MPG"), -- Mileage
(8, 8, "17.4 cubic feet"), -- Boot Space
(8, 9, "7-speed automatic"), -- Transmission
(8, 10, "5.1 inches"), -- Ground Clearance
(8, 11, "7"), -- Airbags
(8, 12, "5-star"); -- NCAP rating

-- Tesla Model S Long Range
INSERT INTO carsfeatures (carid, featureid, featureval) VALUES
(9, 1, "Red"), -- Color
(9, 2, "5"), -- Number of Seats
(9, 3, "200"), -- Speed
(9, 4, "Electric"), -- Motor
(9, 5, "Electric"), -- Fuel Type
(9, 6, "670 hp"), -- Max Power
(9, 7, "402 miles"), -- Mileage
(9, 8, "26.3 cubic feet"), -- Boot Space
(9, 9, "Single-speed automatic"), -- Transmission
(9, 10, "4.7 inches"), -- Ground Clearance
(9, 11, "8"), -- Airbags
(9, 12, "5-star"), -- NCAP rating

-- Tesla Model Y Long Range
(10, 1, "Blue"), -- Color
(10, 2, "7"), -- Number of Seats
(10, 3, "135"), -- Speed
(10, 4, "Electric"), -- Motor
(10, 5, "Electric"), -- Fuel Type
(10, 6, "368 hp"), -- Max Power
(10, 7, "326 miles"), -- Mileage
(10, 8, "68 cubic feet"), -- Boot Space
(10, 9, "Single-speed automatic"), -- Transmission
(10, 10, "6.6 inches"), -- Ground Clearance
(10, 11, "8"), -- Airbags
(10, 12, "5-star"), -- NCAP rating

-- Audi Q5 Premium
(11, 1, "Black"), -- Color
(11, 2, "5"), -- Number of Seats
(11, 3, "135"), -- Speed
(11, 4, "2.0L 4-cylinder"), -- Motor
(11, 5, "Petrol"), -- Fuel Type
(11, 6, "261 hp"), -- Max Power
(11, 7, "25 MPG"), -- Mileage
(11, 8, "25.8 cubic feet"), -- Boot Space
(11, 9, "7-speed automatic"), -- Transmission
(11, 10, "8.2 inches"), -- Ground Clearance
(11, 11, "6"), -- Airbags
(11, 12, "5-star"), -- NCAP rating

-- Ford Explorer XLT
(12, 1, "Silver"), -- Color
(12, 2, "7"), -- Number of Seats
(12, 3, "130"), -- Speed
(12, 4, "2.3L 4-cylinder"), -- Motor
(12, 5, "Petrol"), -- Fuel Type
(12, 6, "300 hp"), -- Max Power
(12, 7, "24 MPG"), -- Mileage
(12, 8, "87.8 cubic feet"), -- Boot Space
(12, 9, "10-speed automatic"), -- Transmission
(12, 10, "7.9 inches"), -- Ground Clearance
(12, 11, "7"), -- Airbags
(12, 12, "5-star"), -- NCAP rating

-- Ford Mustang GT
(13, 1, "Yellow"), -- Color
(13, 2, "4"), -- Number of Seats
(13, 3, "250"), -- Speed
(13, 4, "5.0L V8"), -- Motor
(13, 5, "Petrol"), -- Fuel Type
(13, 6, "450 hp"), -- Max Power
(13, 7, "20 MPG"), -- Mileage
(13, 8, "13.5 cubic feet"), -- Boot Space
(13, 9, "6-speed manual"), -- Transmission
(13, 10, "4.7 inches"), -- Ground Clearance
(13, 11, "4"), -- Airbags
(13, 12, "5-star"), -- NCAP rating

-- Tesla Model 3 Standard Range Plus
(14, 1, "White"), -- Color
(14, 2, "5"), -- Number of Seats
(14, 3, "140"), -- Speed
(14, 4, "Electric"), -- Motor
(14, 5, "Electric"), -- Fuel Type
(14, 6, "283 hp"), -- Max Power
(14, 7, "263 miles"), -- Mileage
(14, 8, "15 cubic feet"), -- Boot Space
(14, 9, "Single-speed automatic"), -- Transmission
(14, 10, "5.5 inches"), -- Ground Clearance
(14, 11, "8"), -- Airbags
(14, 12, "5-star"), -- NCAP rating

-- Audi A3 Premium
(15, 1, "Black"), -- Color
(15, 2, "5"), -- Number of Seats
(15, 3, "135"), -- Speed
(15, 4, "2.0L 4-cylinder"), -- Motor
(15, 5, "Petrol"), -- Fuel Type
(15, 6, "201 hp"), -- Max Power
(15, 7, "28 MPG"), -- Mileage
(15, 8, "12.3 cubic feet"), -- Boot Space
(15, 9, "7-speed automatic"), -- Transmission
(15, 10, "6.6 inches"), -- Ground Clearance
(15, 11, "7"), -- Airbags
(15, 12, "5-star"), -- NCAP rating

-- Audi A4 Premium Plus
(16, 1, "Blue"), -- Color
(16, 2, "5"), -- Number of Seats
(16, 3, "155"), -- Speed
(16, 4, "2.0L 4-cylinder"), -- Motor
(16, 5, "Petrol"), -- Fuel Type
(16, 6, "261 hp"), -- Max Power
(16, 7, "26 MPG"), -- Mileage
(16, 8, "12.3 cubic feet"), -- Boot Space
(16, 9, "7-speed automatic"), -- Transmission
(16, 10, "5.7 inches"), -- Ground Clearance
(16, 11, "7"), -- Airbags
(16, 12, "5-star"), -- NCAP rating

-- Ford F-150 XLT
(17, 1, "Red"), -- Color
(17, 2, "6"), -- Number of Seats
(17, 3, "120"), -- Speed
(17, 4, "3.5L V6"), -- Motor
(17, 5, "Petrol"), -- Fuel Type
(17, 6, "375 hp"), -- Max Power
(17, 7, "21 MPG"), -- Mileage
(17, 8, "52.8 cubic feet"), -- Boot Space
(17, 9, "10-speed automatic"), -- Transmission
(17, 10, "9.4 inches"), -- Ground Clearance
(17, 11, "6"), -- Airbags
(17, 12, "5-star"), -- NCAP rating

-- Volkswagen Tiguan SEL
(18, 1, "Gray"), -- Color
(18, 2, "5"), -- Number of Seats
(18, 3, "130"), -- Speed
(18, 4, "2.0L 4-cylinder"), -- Motor
(18, 5, "Petrol"), -- Fuel Type
(18, 6, "184 hp"), -- Max Power
(18, 7, "24 MPG"), -- Mileage
(18, 8, "37.6 cubic feet"), -- Boot Space
(18, 9, "8-speed automatic"), -- Transmission
(18, 10, "7.9 inches"), -- Ground Clearance
(18, 11, "6"), -- Airbags
(18, 12, "5-star"); -- NCAP rating


-- -- NEWS
-- DROP TABLE IF EXISTS news;
-- CREATE TABLE IF NOT EXISTS news (
--     newsid INT PRIMARY KEY AUTO_INCREMENT,
--     title VARCHAR(150),
--     summary VARCHAR(400),
--     article VARCHAR(2000),
--     image VARCHAR(50)
-- );

-- INSERT INTO news (title, summary, article, image) VALUES
-- ("New Electric Car Models Unveiled at Auto Show", "Highlights from the latest auto show showcasing the future of electric vehicles.", "The recent auto show in the city unveiled several new electric car models from various manufacturers. These models promise improved range, faster charging, and innovative features. Industry experts believe that electric vehicles will continue to dominate the market in the coming years.", "electric_car_show.jpg"),

-- ("SpaceX Launches New Satellite for Global Internet Coverage", "SpaceX successfully launched a new satellite that aims to provide global internet coverage.", "SpaceX, the private space company founded by Elon Musk, successfully launched a new satellite into orbit. The satellite is part of SpaceX""s ambitious project to provide high-speed internet access to remote and underserved areas around the world. This launch marks another milestone for SpaceX and its mission to revolutionize global connectivity.", "spacex_satellite_launch.jpg"),

-- ("Health Experts Warn of New Flu Outbreak", "Health officials are monitoring a new strain of the flu virus that has the potential to cause a widespread outbreak.", "Health experts are closely monitoring a new strain of the flu virus that has emerged in several regions. Preliminary tests indicate that the new strain may be more contagious than previous variants. Authorities are urging the public to take precautions, such as getting vaccinated and practicing good hygiene, to prevent the spread of the virus.", "flu_outbreak_warning.jpg"),

-- ("Tech Giants Announce Collaboration on AI Ethics Guidelines", "Leading technology companies join forces to develop ethical guidelines for artificial intelligence.", "Several leading technology companies, including Google, Microsoft, and Facebook, have announced a collaborative effort to develop ethical guidelines for the use of artificial intelligence. The initiative aims to address concerns about the potential risks and ethical implications of AI technology. Experts hope that these guidelines will help ensure the responsible and beneficial use of AI in various applications.", "ai_ethics_guidelines.jpg"),

-- ("New Study Finds Benefits of Mediterranean Diet for Heart Health", "A new study highlights the benefits of the Mediterranean diet in reducing the risk of heart disease.", "A recent study published in a leading medical journal has found that following a Mediterranean diet can significantly reduce the risk of heart disease. The diet, which is rich in fruits, vegetables, whole grains, and olive oil, has long been associated with various health benefits. Researchers recommend adopting a Mediterranean-style eating pattern for improved heart health.", "mediterranean_diet_heart_health.jpg");

-- -- OPINONS
-- DROP TABLE IF EXISTS opinions;
-- CREATE TABLE IF NOT EXISTS opinions (
--     opinionid INT PRIMARY KEY AUTO_INCREMENT,
--     userid INT,
--     carid INT,
--     content VARCHAR(500),
--     status VARCHAR(20), -- awaiting vs accepted vs refused
--     FOREIGN KEY (userid) REFERENCES users(userid),
--     FOREIGN KEY (carid) REFERENCES cars(carid)
-- );

-- -- RATES
-- DROP TABLE IF EXISTS rates;
-- CREATE TABLE IF NOT EXISTS rates (
--     rateid INT PRIMARY KEY AUTO_INCREMENT,
--     userid INT,
--     carid INT,
--     rate INT,
--     status VARCHAR(20), -- awaiting vs accepted vs refused
--     FOREIGN KEY (userid) REFERENCES users(userid),
--     FOREIGN KEY (carid) REFERENCES cars(carid)
-- );

