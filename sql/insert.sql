START TRANSACTION;

ALTER TABLE match_table rename to match_record;

INSERT INTO user (
  mailaddress, 
  password, 
  nickname
)
VALUES(
  'user1@mail.com',
  'password1',
  'test-user1'
),(
  'user2@mail.com',
  'password2',
  'test-user2'
),(
  'user3@mail.com',
  'password3',
  'test-user3'
),(
  'user4@mail.com',
  'password4',
  'test-user4'
),(
  'user5@mail.com',
  'password5',
  'test-user5'
);

INSERT INTO task (
  title, 
  detail, 
  period, 
  user_id
)
VALUES(
  'Task 1', 
  'Do something', 
  '2023-10-20',
  1
),(
  'Task 2',
 'Do something else',   
 '2023-10-18 14:30:00',
 2
),(
  'Task 3',
 'Do something else',   
 '2023-10-18 14:30:00',
 3
),(
  'Task 4',
 'Do something else',   
 '2023-10-18 14:30:00',
 4
),(
  'Task 5',
 'Do something else',   
 '2023-10-18 14:30:00',
 5
);

INSERT INTO match_record 
  (user_is_win, enemy_user_id, user_id)
VALUES 
  (0, 2, 1), 
  (0, 3, 4), 
  (1, 5, 1);

INSERT INTO skill 
  (skill_name, skill_description)
VALUES 
  ('スキル１', 'スキル１の説明です。'), 
  ('スキル２', 'スキル２の説明です。'), 
  ('スキル３', 'スキル３の説明です。');

COMMIT;
