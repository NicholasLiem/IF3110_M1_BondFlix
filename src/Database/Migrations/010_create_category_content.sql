CREATE TABLE IF NOT EXISTS category_content (
    category_id INT,
    content_id INT,
    PRIMARY KEY (category_id, content_id),
    FOREIGN KEY (category_id) REFERENCES category(category_id),
    FOREIGN KEY (content_id) REFERENCES content(content_id)
);