#drop database techno_library;

create database techno_library;




use techno_library;

create table users( 
	ID int primary key auto_increment ,
	name varchar(40), 
	lastName varchar(40), 
	email varchar(30), 
	password varchar(20) 
);

create table user_book (
	FK_user int,
    book int,
    constraint FK_USER_UB foreign key (FK_user) references users(ID),
	constraint PK_UB primary key (FK_user,book)
);