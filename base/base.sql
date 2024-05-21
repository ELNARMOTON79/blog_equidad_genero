CREATE DATABASE blog;

USE blog;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2024 a las 22:10:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `blog`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(2) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(6, 'Gender Equality'),
(7, 'Social Justice'),
(8, 'Human Rights'),
(10, 'Sustainable Developm');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codes`
--

CREATE TABLE `codes` (
  `code` varchar(100) NOT NULL,
  `id_user` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `codes`
--

INSERT INTO `codes` (`code`, `id_user`) VALUES
('HREDejhjvRxD6wgHjsUOrYpuHAMjM3sN9Xm0EIbHdsNzDKihtKtTfF2U2qiTksVrdFqibwZ3bckwTN15RYmcp13xdE2tkogJNdCD', 1),
('04VTyIj7GwsYJ5xOlxruNZvTE8LB9yaqkwk2bi5S1wIrcFHphhupF6md8SyhsjEGshnrFVEUt6nMd3U2VKblY5HiRhJFvQIhFHEK', 1),
('8O18zqKyt5brOLXyCzauZ2Y6UjcAHcApAYBQ8jMpFBcIwefPQkhV8zUlvB7YMhEjF9IzUz10WTYLOz4gH6jw6aMQcB3a1KGAKBhR', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(100) NOT NULL,
  `admin_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `admin_id`, `name`, `title`, `content`, `category`, `image`, `date`, `time`) VALUES
(28, 0, 'elnarmoton69', ' Category: Gender Equality  Advancing Gender Equality in Society', '<p>Gender equality remains a crucial issue in our society, demanding attention and action. Achieving true equality requires dismantling long-standing stereotypes and biases that limit opportunities based on gender.</p>\r\n<p>Education plays a pivotal role in promoting gender equality. By ensuring equal access to education for all genders, we empower individuals to reach their full potential and contribute meaningfully to society.</p>\r\n<p>Workplace equality is also essential. This includes implementing policies that support equal pay for equal work, providing parental leave for all genders, and fostering inclusive environments where everyone can thrive without discrimination.</p>\r\n<p>Representation in leadership positions is another key aspect. Encouraging diverse leadership in politics, business, and other sectors helps create policies and practices that reflect the needs and experiences of all individuals.</p>\r\n<p>Finally, cultural and social change is necessary to challenge and transform deeply ingrained attitudes and behaviors. This involves raising awareness, promoting positive role models, and advocating for change at all levels of society.</p>\r\n<p>By working together, we can create a more just and equitable world where everyone, regardless of gender, has the opportunity to succeed and contribute to their communities.</p>', 'Gender Equality', '3.jpg', '2024-05-20', '2024-05-20 19:52:35'),
(29, 0, 'elnarmoton69', 'Promoting Social Justice Through Gender Equality', '<p>Gender equality is a fundamental aspect of social justice. Ensuring that all individuals, regardless of their gender, have equal rights and opportunities is essential for a fair and just society.</p>\r\n<p>One critical area where gender equality impacts social justice is access to healthcare. All genders should have access to comprehensive and unbiased healthcare services, addressing specific needs and promoting overall well-being.</p>\r\n<p>Economic empowerment is another vital factor. By supporting equal opportunities in employment, including equal pay and career advancement, we help reduce poverty and boost economic growth. Initiatives that provide training and resources for women and other marginalized genders are crucial in this effort.</p>\r\n<p>Legal reforms play a significant role in promoting gender equality. Enacting and enforcing laws that protect against gender-based violence, discrimination, and harassment helps create safer environments for everyone.</p>\r\n<p>Education is also a cornerstone of social justice. Providing equal educational opportunities for all genders helps break the cycle of inequality and fosters a more inclusive and informed society.</p>\r\n<p>Inclusion and representation are equally important. Ensuring that diverse voices are heard in decision-making processes, from local communities to global platforms, leads to more equitable and effective solutions.</p>\r\n<p>Achieving gender equality is not just a moral imperative; it is a pathway to a more just and equitable society for all. By addressing these issues collectively, we can make significant strides towards a world where everyone has the opportunity to thrive.</p>', 'Social Justice', '4.jpg', '2024-05-20', '2024-05-20 19:53:28'),
(30, 0, 'elnarmoton69', 'Gender Equality as a Fundamental Human Right', '<p>Gender equality is a fundamental human right that is essential for the development and well-being of individuals and societies. Ensuring that all people, regardless of gender, can enjoy the same rights and opportunities is crucial for building a fair and just world.</p>\r\n<p>One of the key aspects of gender equality in the context of human rights is the elimination of gender-based violence. This includes domestic violence, sexual harassment, and trafficking. Protecting individuals from such abuses is a critical step towards upholding their human rights and dignity.</p>\r\n<p>Access to education is another vital component. Education empowers individuals, providing them with the knowledge and skills needed to participate fully in society. Ensuring equal educational opportunities for all genders helps break down barriers and promotes social and economic development.</p>\r\n<p>Economic rights are also fundamental. This includes the right to work, equal pay for equal work, and the ability to own property and access financial services. By removing economic barriers and discrimination, we can create more inclusive and prosperous societies.</p>\r\n<p>Reproductive rights are an essential part of gender equality. Every individual should have the right to make informed decisions about their own body and reproductive health without coercion or discrimination.</p>\r\n<p>Finally, political and social participation is crucial. Ensuring that all genders are represented in leadership roles and decision-making processes leads to more inclusive and equitable policies that reflect the needs and rights of everyone.</p>\r\n<p>Promoting gender equality as a human right is not only a matter of justice but also a key to unlocking the full potential of our societies. By addressing these issues, we can create a world where everyone can enjoy their rights and freedoms fully and equally.</p>', 'Human Rights', 'imagen_2024-05-20_135520148.png', '2024-05-20', '2024-05-20 19:55:21'),
(31, 0, 'elnarmoton69', 'Gender Equality for Sustainable Development', '<p style=\"text-align: justify;\">Gender equality is essential for achieving sustainable development. When all genders have equal opportunities and rights, societies become more resilient, prosperous, and sustainable.</p>\r\n<p style=\"text-align: justify;\">One critical area where gender equality impacts sustainable development is in education. Educating all genders leads to a more knowledgeable and skilled workforce, which is crucial for economic growth and innovation. Educated individuals are more likely to contribute to sustainable practices and solutions in their communities.</p>\r\n<p style=\"text-align: justify;\">Economic empowerment is another vital factor. Ensuring that all genders have equal access to job opportunities, fair wages, and financial resources helps reduce poverty and fosters economic stability. Inclusive economic growth benefits everyone and supports sustainable development goals.</p>\r\n<p style=\"text-align: justify;\">Health and well-being are also central to sustainable development. Providing equal access to healthcare services and addressing gender-specific health needs contribute to healthier populations. This, in turn, supports economic productivity and reduces healthcare costs in the long run.</p>\r\n<p style=\"text-align: justify;\">Environmental sustainability is closely linked to gender equality. Women and marginalized genders often play key roles in managing natural resources and advocating for environmental protection. Empowering them with the necessary tools and resources enhances their ability to contribute to sustainable environmental practices.</p>\r\n<p style=\"text-align: justify;\">Political participation and leadership are crucial as well. Inclusive governance, where all genders are represented in decision-making processes, leads to more effective and equitable policies. These policies are more likely to address diverse needs and promote sustainable development.</p>\r\n<p style=\"text-align: justify;\">In conclusion, gender equality is not just a social or moral issue; it is a cornerstone of sustainable development. By ensuring that all genders have equal opportunities and rights, we create more resilient and prosperous societies that can sustain development for future generations.</p>', 'Sustainable Developm', 'imagen_2024-05-20_140250827.png', '2024-05-20', '2024-05-20 20:02:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `type_user` int(1) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `profile`, `type_user`, `correo`) VALUES
(0, 'juan', '14122005', '', 1, 'rvuelvas@ucol.mx'),
(1, 'elnarmoton69', '14122005a', 'image.jpg', 0, 'rafaelalexandro6949@gmail.com'),
(2, 'rafa', '12345678', 'image.png', 1, 'rafaelalex6949@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
