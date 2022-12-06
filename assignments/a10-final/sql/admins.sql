drop table admins;
create table admins
(
  id int not null auto_increment primary key,
  name varchar(30) not null,
  email varchar(30) not null,
  password varchar(70) not null,
  status varchar(15) not null
) ENGINE = InnoDB;

insert into admins (name, email, password, status)
values
(
  "Garrett Drake",
  "gadrake@admin.com",
  "$2y$10$.vbwtok85NOh/ZDaXWpLIe3ic5yWFy.GJnKQUfZDO4pOja/XRqq6y",
  "admin"
),
(
  "Garrett Drake",
  "gadrake@staff.com",
  "$2y$10$/sjGHTH9/TdKeP7.HS/2lefDDb5C0xDpmfywb2UogZ3UKm.YyLzGK",
  "staff"
)
