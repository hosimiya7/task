drop table tasks;

create table tasks(
  id INT auto_increment PRIMARY KEY, 
  category VARCHAR(256),
  date DATE,
  content TEXT,
  is_done BOOLEAN DEFAULT FALSE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);