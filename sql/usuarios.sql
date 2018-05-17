create table users (
    id BIGINT AUTO_INCREMENT primary key,
    name VARCHAR(200) NOT NULL,
    login VARCHAR(60) NOT NULL,
    password VARCHAR(60) NOT NULL
);