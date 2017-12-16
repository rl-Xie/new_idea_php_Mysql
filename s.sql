CREATE TABLE product (
  id         INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  title      VARCHAR(32)     NOT NULL,
  price      DOUBLE UNSIGNED NOT NULL,
  cover_path VARCHAR(2084),
  prop       TEXT,
  sales      INT,
  created_at DATETIME,
  updated_at DATETIME
);


CREATE TABLE cat (
  id         INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  title      VARCHAR(32),
  cover_path VARCHAR(2084),
  created_at DATETIME,
  updated_at DATETIME
);


CREATE TABLE user (
  id         INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  username   VARCHAR(24),
  password   VARCHAR(128),
  location   TEXT COMMENT '{location_id: 1, detail: "吴家园2单元1001"}',
  created_at DATETIME,
  updated_at DATETIME
);

CREATE TABLE cart (
  id         INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  product_id INT UNSIGNED NOT NULL,
  count      INT UNSIGNED NOT NULL,
  user_id    INT UNSIGNED NOT NULL,
  #   status     VARCHAR(32)              DEFAULT 'active',
  FOREIGN KEY fk_product_id(product_id)
  REFERENCES product (id),
  FOREIGN KEY fk_user_id(user_id)
  REFERENCES user (id)
);

CREATE TABLE `order` (
  id        INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  user_id   INT UNSIGNED NOT NULL,
  order_num VARCHAR(64)  NOT NULL COMMENT '如：A-8788627842',
  product   TEXT COMMENT '[{id: 1, count: 2},{id: 2, count: 5}]',
  snapshot  TEXT COMMENT '{product: [{id: 1, cover_url: "...", price: 5}], user: {id: 1, username: "whh"}}',
  FOREIGN KEY fk_user_id(user_id)
  REFERENCES user (id)
);
