CREATE TABLE user (
    user_id INT PRIMARY KEY,
    mailaddress VARCHAR(255),
    password VARCHAR(255),
    nickname VARCHAR(255),
    icon_path VARCHAR(255),
    skill_point INT,
    rank_point INT,
    hitpoint INT,
    attack INT,
    defence INT,
    agility INT,
    luck INT
);

CREATE TABLE task (
    task_id INT PRIMARY KEY,
    title VARCHAR(255),
    detail TEXT,
    period DATETIME,
    is_complete TINYINT(1),
    completion_time DATETIME,
    created_time DATETIME,
    last_edit_time DATETIME,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE match_table (
    match_id INT PRIMARY KEY,	
    user_is_win TINYINT(1),
    enemy_user_id INT,
    user_id	INT,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE skill (
    skill_id INT PRIMARY KEY,
    skill_name VARCHAR(255),
    skill_description TEXT
);
