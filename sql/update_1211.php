CREATE VIEW v_game_user AS
SELECT user_id, nickname, skill_point, rank_point, 
hitpoint + attack + defence + agility + luck AS level, 
hitpoint, attack, defence, agility, luck
FROM user;