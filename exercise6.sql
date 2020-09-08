/*
создаем БД
*/
create database if not exists library
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

use library;
/*
создаем таблицы, связь многие ко многим
*/
CREATE TABLE authors (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(100) NOT NULL
);

CREATE TABLE books (
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(100) NOT NULL
);

CREATE TABLE authors_books (
	author_id INT(10),
	book_id INT(10),
	FOREIGN KEY (author_id) REFERENCES authors(id)
	ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id)
    ON DELETE CASCADE,
	PRIMARY KEY(book_id, author_id)
);

CREATE INDEX author_id ON authors_books(author_id);
/*
наполняем таблицы данными / Написать запрос, чтобы заполнить базу информацией
*/
INSERT INTO authors (name) VALUES
	('Михаил Булгаков'),
	('Джек Лондон'),
	('Иоган Гёте'),
	('Александр Пушкин'),
	('Эрих Мария Ремарк'),
	('И. Ильф'),
	('E. Петров'),
	('Генри Лайон Олди'),
	('Андрей Валентинов'),
	('Марина и Сергей Дяченко'),
	('Алексей Пехов'),
	('Елена Бычкова'),
	('Наталья Турчанинова');


INSERT INTO books(title) VALUES
	("Мастер и Маргарита"),
	("Фауст"),
	("Белый клык"),
	("Триумфальная арка"),
	("Жизнь взаймы"),
	("Евгений Онегин"),
	("Двенадцать стульев"),
	("Рубеж"),
	("Заклинатели");

INSERT INTO authors_books (author_id, book_id) VALUES
	(2, 1),
	(2, 2),
	(3, 3),
	(5, 4),
	(5, 5),
	(4, 6),
	(6, 7),
	(7, 7),
	(8, 8),
	(9, 8),
	(10, 8),
	(11, 9),
	(12, 9),
	(13, 9);

/*
Написать запрос для обновления автора у конкретной книги.
*/
UPDATE authors_books
    SET author_id= (SELECT id FROM authors WHERE name = 'Эрих Мария Ремарк')
    WHERE book_id
    IN (SELECT id FROM books WHERE title = 'Мастер и Маргарита');

/*
Вытащить список книг, которые написаны 3-мя со-авторами. То есть получить отчет «книга — количество соавторов» и
отфильтровать те, у которых со-авторов меньше 3х.
*/
SELECT books.title, COUNT(authors_books.book_id) as `number_of_authors`
    FROM books
    INNER JOIN authors_books ON (authors_books.book_id = books.id )
    GROUP BY books.title
    HAVING COUNT(number_of_authors) < 3;

/*
Написать запрос на удаление книги, написанной определенным автором.
*/

DELETE FROM authors_books
    WHERE author_id
    IN (SELECT id FROM authors WHERE name = 'Эрих Мария Ремарк');
