
-- create database phptodo
create  database if not exists phptodo;

-- select db phptodo to perform SQL operations
use phptodo;

-- table structure for todo_lists 
create table if not exists todo_lists (
    id int(11) not null comment 'Primary key',
    task mediumtext not null,
    status int(1) default 0 comment '0=Active, 1=Done, 3=Delete',
    created datetime not null default current_timestamp
);

-- alter table add primary key to column id
alter table todo_lists add primary key(id);

-- alter table to add auto_increment to column id
alter table todo_lists modify id int(11) not null auto_increment comment 'Primary key'; 