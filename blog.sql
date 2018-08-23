CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(50),
    body TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

INSERT INTO articles (title,body,created)
    VALUES ('The title', 'This is the article body.', datetime('now'));
INSERT INTO articles (title,body,created)
    VALUES ('A title once again', 'And the article body follows.', datetime('now'));
INSERT INTO articles (title,body,created)
    VALUES ('Title strikes back', 'This is really exciting! Not.', datetime('now'));