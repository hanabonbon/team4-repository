CREATE TABLE user (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    mailaddress VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nickname VARCHAR(255) NOT NULL,
    icon_path VARCHAR(255) DEFAULT 'default_icon.png',
    skill_point INT NOT NULL DEFAULT 1,
    rank_point INT NOT NULL DEFAULT 1,
    hitpoint INT NOT NULL DEFAULT 1,
    attack INT NOT NULL DEFAULT 1,
    defence INT NOT NULL DEFAULT 1,
    agility INT NOT NULL DEFAULT 1,
    luck INT NOT NULL DEFAULT 1
);

CREATE TABLE task (
    task_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL DEFAULT 'タイトル',
    detail TEXT NOT NULL,
    period DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    is_complete TINYINT(1) DEFAULT 0,
    completion_time DATETIME,
    created_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    last_edit_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE match_table (
    match_id INT PRIMARY KEY AUTO_INCREMENT,	
    user_is_win TINYINT(1) NOT NULL, 
    enemy_user_id INT NOT NULL,
    user_id	INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

CREATE TABLE skill (
    skill_id INT PRIMARY KEY AUTO_INCREMENT,
    skill_name VARCHAR(255) NOT NULL,
    skill_description TEXT NOT NULL
);
