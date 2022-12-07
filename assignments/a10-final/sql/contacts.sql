drop table contacts;
create table contacts
(
  id int not null auto_increment primary key,
  name varchar(30) not null,
  address varchar(50) not null,
  city varchar(20) not null,
  state char(2) not null,
  phone char(12) not null,
  email varchar(30) not null,
  dob varchar(10) not null,
  contacts varchar(100) not null,
  age varchar(6) not null
)
