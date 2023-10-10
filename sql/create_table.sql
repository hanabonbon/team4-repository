CREATE TABLE user (
    user_id INT PRIMARY KEY,
    mailaddress VARCHAR(255),
    password VARCHAR(255),
    nickname VARCHAR(255),
    icon_path VARCHAR(255),
    rank_point INT,
    hitpoint INT,
    attack INT,
    defence INT,
    agility INT,
    luck INT
);
