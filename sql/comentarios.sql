create table comments (
    id BIGINT AUTO_INCREMENT primary key,
    user_id BIGINT NOT NULL,
    message text NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);