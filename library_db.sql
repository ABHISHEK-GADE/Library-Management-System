-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 08:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `copies` int(11) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `publisher`, `year`, `category`, `copies`, `cover_image`) VALUES
(1, 'The Alchemist', 'Paulo Coelho', '9788172234980', 'HarperCollins India', '2005', 'Fiction', 5, 'alchemist.jpg'),
(2, 'Wings of Fire', 'A.P.J. Abdul Kalam', '9788173711466', 'Universities Press', '1999', 'Autobiography', 4, 'wings_of_fire.jpg'),
(3, 'The White Tiger', 'Aravind Adiga', '9788172238476', 'HarperCollins India', '2008', 'Fiction', 6, 'white_tiger.jpg'),
(4, 'Bhagavad Gita', 'Vyasa', '9789389432007', 'Gita Press', '2020', 'Spiritual', 10, 'bhagavad_gita.jpg'),
(5, 'India After Gandhi', 'Ramachandra Guha', '9789388292069', 'Picador India', '2007', 'History', 3, 'india_after_gandhi.jpg'),
(6, 'Train to Pakistan', 'Khushwant Singh', '9780143065883', 'Penguin India', '1956', 'Historical Fiction', 5, 'train_to_pakistan.jpg'),
(7, 'Sapiens', 'Yuval Noah Harari', '9780099590088', 'Penguin India', '2014', 'History', 7, 'sapiens.jpg'),
(8, 'Rich Dad Poor Dad', 'Robert Kiyosaki', '9788186775213', 'Plata Publishing', '1997', 'Finance', 6, 'rich_dad_poor_dad.jpg'),
(9, '2 States', 'Chetan Bhagat', '9788129135520', 'Rupa Publications', '2009', 'Romance', 8, '2_states.jpg'),
(10, 'The Secret', 'Rhonda Byrne', '9781847370297', 'Simon & Schuster India', '2006', 'Self-Help', 4, 'the_secret.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `issued_books`
--

CREATE TABLE `issued_books` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('issued','returned') DEFAULT 'issued',
  `fine` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issued_books`
--

INSERT INTO `issued_books` (`id`, `book_id`, `member_id`, `issue_date`, `return_date`, `status`, `fine`) VALUES
(1, 1, 2, '2024-02-10', '2024-02-20', 'issued', 0.00),
(2, 3, 5, '2024-02-05', '2024-02-15', 'returned', 10.00),
(3, 6, 8, '2024-02-08', '2024-02-18', 'issued', 0.00),
(4, 4, 1, '2024-02-12', '2024-02-22', 'issued', 0.00),
(5, 7, 3, '2024-02-09', '2024-02-19', 'returned', 0.00),
(6, 2, 6, '2024-02-06', '2024-02-16', 'issued', 0.00),
(7, 8, 9, '2024-02-04', '2024-02-14', 'returned', 20.00),
(8, 9, 4, '2024-02-11', '2024-02-21', 'returned', 1920.00),
(9, 10, 10, '2024-02-07', '2024-02-17', 'issued', 0.00),
(10, 5, 7, '2024-02-03', '2024-02-13', 'returned', 0.00),
(11, 1, 2, '2025-03-11', '2025-03-12', 'issued', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

CREATE TABLE `librarians` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`id`, `name`, `email`, `password`) VALUES
(1, 'Varad', 'varad@librarian.in', '$2y$10$wdwdo9Y8tfoX1iw/z8kcUusTLBty8jEJ2jGn9It0eFcuZgLeFMqxO');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `membership_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `phone`, `address`, `membership_id`) VALUES
(1, 'Amit Sharma', 'amit.sharma@example.com', '9876543210', 'Delhi, India', 'MEMB001'),
(2, 'Priya Verma', 'priya.verma@example.com', '9865321470', 'Mumbai, India', 'MEMB002'),
(3, 'Rahul Yadav', 'rahul.yadav@example.com', '9845612378', 'Lucknow, India', 'MEMB003'),
(4, 'Sneha Nair', 'sneha.nair@example.com', '9812356745', 'Kochi, India', 'MEMB004'),
(5, 'Rohan Gupta', 'rohan.gupta@example.com', '9807654321', 'Bangalore, India', 'MEMB005'),
(6, 'Meera Iyer', 'meera.iyer@example.com', '9823456789', 'Chennai, India', 'MEMB006'),
(7, 'Vikram Singh', 'vikram.singh@example.com', '9832165498', 'Pune, India', 'MEMB007'),
(8, 'Ananya Bose', 'ananya.bose@example.com', '9813456723', 'Kolkata, India', 'MEMB008'),
(9, 'Harsh Mehta', 'harsh.mehta@example.com', '9845612398', 'Ahmedabad, India', 'MEMB009'),
(10, 'Tanya Kapoor', 'tanya.kapoor@example.com', '9871234567', 'Hyderabad, India', 'MEMB010');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `librarians`
--
ALTER TABLE `librarians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `membership_id` (`membership_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `issued_books`
--
ALTER TABLE `issued_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `librarians`
--
ALTER TABLE `librarians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `issued_books`
--
ALTER TABLE `issued_books`
  ADD CONSTRAINT `issued_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issued_books_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
