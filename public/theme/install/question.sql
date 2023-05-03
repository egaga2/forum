-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th9 11, 2021 lúc 05:58 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `blackexpo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '401xdssh@gmail.com', '2022-03-14 22:03:00', '$2y$10$AIYskwA.E04r5uNSqyZXAu.nU27Jwo5Gn.84S562r5pzkeSPBaNHS', 'j3djbHC8h5hd9dwZCGBtCsL95trrQFxMJXiu3eHB4dKxGNunNIeYOJWdbukP', '2021-03-14 22:03:00', '2021-09-11 03:57:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ads`
--

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ads`
--

INSERT INTO `ads` (`id`, `title`, `code`, `created_at`, `updated_at`) VALUES
(6, 'below_right_column', '<div class=\"ad-banner mb-4 mx-auto\">\r\n            <span class=\"ad-text\">290x500</span>\r\n        </div>', NULL, '2021-09-10 08:41:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qid` bigint(20) UNSIGNED NOT NULL,
  `userid` bigint(20) UNSIGNED NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `votes` int(11) NOT NULL DEFAULT 0,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`id`, `qid`, `userid`, `body`, `votes`, `on`) VALUES
(1, 1, 1, '&lt;p&gt;I&amp;#39;m not able to get the data attribute from a button element.&amp;nbsp;I&amp;#39;m not able to get the data attribute from a button element.&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;&amp;lt;button\n class=&amp;quot;btn btn-solid navigate&amp;quot;\n value=&amp;quot;2&amp;quot;\n data-productId={{$product-&amp;gt;id}}\n id=&amp;quot;size-click&amp;quot;\n &amp;gt;\n Next\n&amp;lt;/button&amp;gt;\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;Then I attempt to get it like so:&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;$(&amp;quot;#size-click&amp;quot;).click(() =&amp;gt; {\n let width = $(&amp;quot;#prod-width&amp;quot;).val();\n let height = $(&amp;quot;#prod-height&amp;quot;).val();\n var prodId = $(this).data(&amp;quot;productId&amp;quot;);\n\n console.log(&amp;#39;this is prodId&amp;#39;);\n console.log(prodId);\n\n const data = {\n      prodId: prodId,\n      step: &amp;#39;Size&amp;#39;,\n      width: width,\n      height: height,\n    }\n\n    postDataEstimate(data);\n\n  })\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;I&amp;#39;m also trying this:&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;var prodId = $(this).attr(&amp;#39;data-productId&amp;#39;);\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;Can you let me know what I&amp;#39;m missing?&lt;/p&gt;', 0, '2021-09-10 15:49:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `awardedBadges`
--

DROP TABLE IF EXISTS `awardedBadges`;
CREATE TABLE `awardedBadges` (
  `id` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `awnserReplies`
--

DROP TABLE IF EXISTS `awnserReplies`;
CREATE TABLE `awnserReplies` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `votes` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `badges`
--

DROP TABLE IF EXISTS `badges`;
CREATE TABLE `badges` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `badges`
--

INSERT INTO `badges` (`id`, `name`, `type`, `description`, `priority`, `value`, `on`) VALUES
(1, 'Favorite', 1, 'Question voted by <value> users ', 3, 25, '2018-08-06 11:30:14'),
(2, 'Nice Question', 1, 'Question score of <value> or more ', 3, 10, '2018-08-06 11:31:04'),
(3, 'Good Question', 1, 'Question score of <value> or more', 3, 25, '2018-08-06 11:33:56'),
(4, 'Great Question', 1, 'Question score of <value> or more', 3, 100, '2018-08-06 11:36:31'),
(5, 'Popular Question', 1, 'Question with <value> views', 1, 1000, '2018-08-06 11:42:11'),
(6, 'Scholar', 1, 'Ask a question and accept an answer', 3, 0, '2018-08-06 11:44:37'),
(7, 'Student', 1, 'First question with score of <value> or more', 3, 1, '2018-08-06 11:45:01'),
(9, 'Guru', 2, 'Answer and score of <value> or more', 3, 40, '2018-08-06 11:46:59'),
(10, 'Nice Answer', 2, 'Answer score of <value> or more', 3, 10, '2018-08-06 11:48:28'),
(11, 'Good Answer', 2, 'Answer score of <value> or more ', 3, 25, '2018-08-06 11:48:46'),
(12, 'Great Answer', 2, 'Answer score of <value> or more', 2, 100, '2018-08-06 11:50:13'),
(13, 'Self-Learner', 2, 'Answer your own question with score of <value> or more', 3, 3, '2018-08-06 11:50:35'),
(14, 'Teacher', 2, 'Answer a question with score of <value> or more ', 3, 1, '2018-08-06 11:51:02'),
(15, 'Autobiographer', 3, 'Complete \"About Me\" section of user profile', 3, 0, '2018-08-06 11:52:22'),
(16, 'Commentator', 3, 'Leave <value> comments', 3, 10, '2018-08-06 11:52:41'),
(17, 'Pundit', 3, 'Leave <value> comments with score of 5 or more', 3, 5, '2018-08-06 11:53:12'),
(19, 'Yearling', 3, 'Active member for a year, earning at least <value> reputation', 1, 200, '2018-08-06 11:54:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `permalink` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `permalink`, `description`, `status`, `on`) VALUES
(1, 'web', 'web', 'Do not use this tag. For questions related to an aspect of the world wide web, use a more specific tag for it, such as [uri], [html], [http] or [w3c].', 1, '2021-07-19 07:26:36'),
(2, 'php', 'php', 'PHP is a widely used, high-level, dynamic, object-oriented and interpreted scripting language primarily designed for server-side web development. ', 1, '2021-07-19 07:26:36'),
(3, 'Java Script', 'javascript', 'JavaScript (not to be confused with Java) is a high-level, dynamic, multi-paradigm, weakly-typed language used for both client-side and server-side scripting. Its primary use is in rendering and allowing manipulation of web pages. Use this tag for questions regarding ECMAScript and its various dialects/implementations (excluding ActionScript and Google-Apps-Script).', 1, '2021-07-19 07:26:36'),
(4, 'Jquery', 'jquery', 'jQuery is a popular cross-browser JavaScript library that facilitates Document Object Model (DOM) traversal, event handling, animations, and AJAX interactions by minimizing the discrepancies across browsers. A question tagged jquery should be related to jquery, so jquery should be used by the code in question and at least a jquery usage-related elements need to be in the question.', 1, '2021-07-19 07:26:36'),
(5, 'CodeIgniter', 'codeigniter', 'CodeIgniter is an open-source PHP web development framework created by EllisLab Inc and it has been adopted by British Columbia Institute of Technology. The framework implements a modified version of the Model-View-Controller design pattern. Use this tag for questions about CodeIgniter classes, methods, functions, syntax and use PHP web development framework created by EllisLab Inc and it has been adopted by British Columbia Institute of Technology. ', 1, '2021-07-19 07:26:36'),
(6, 'ASP.net', 'aspnet', 'ASP.NET is a Microsoft web application development framework that allows programmers to build dynamic web sites, web applications and web services. It is useful to use this tag in conjunction with the project type tag e.g. [asp.net-mvc], [asp.net-webforms], or [asp.net-web-api]. Do NOT use this tag for questions about ASP.NET Core - use [asp.net-core] instead.', 1, '2021-07-19 07:26:36'),
(7, 'Java', 'java', 'Java (not to be confused with JavaScript or JScript or JS) is a general-purpose object-oriented programming language designed to be used in conjunction with the Java Virtual Machine (JVM). \"Java platform\" is the name for a computing system that has installed tools for developing and running Java programs. Use this tag for questions referring to the Java programming language or Java platform tools. ', 1, '2021-07-19 07:26:36'),
(8, 'HTML', 'html', 'HTML (Hyper Text Markup Language) is the standard markup language used for structuring web pages and formatting content. HTML describes the structure of a website semantically along with cues for presentation, making it a markup language, rather than a programming language. HTML works in conjunction primarily with CSS and JavaScript, adding presentation and behaviour to the pages. The most recent revision to the HTML specification is HTML5.2. ', 1, '2021-07-19 07:26:36'),
(9, 'CSS', 'css', 'CSS (Cascading Style Sheets) is a representation style sheet language used for describing the look and formatting of HTML (Hyper Text Markup Language), XML (Extensible Markup Language) documents and SVG elements including (but not limited to) colors, layout, fonts, and animations.', 1, '2021-07-19 07:26:36'),
(10, 'Apache Server', 'apache_server', 'Use this tag (along with an appropriate programming-language tag) for programming questions relating to the Apache HTTP Server. Do not use this tag for questions about other Apache Foundation products. Note that server configuration questions are usually a better fit on https://serverfault.com', 1, '2021-07-19 07:26:36'),
(11, 'C Language', 'c', 'C is a general-purpose computer programming language used for operating systems, libraries, games and other high performance work. This tag should be used with general questions concerning the C language, as defined in the ISO 9899:2011 standard. If applicable, include a version-specific tag such as c99 or c90 for questions relating to older language standards. C is distinct from C++ and it should not be combined with the C++ tag absent a rational reason.', 1, '2021-07-19 07:26:36'),
(12, 'C#', 'csharp', 'C# (pronounced \"see sharp\") is a high level, object-oriented programming language that is designed for building a variety of applications that run on the .NET Framework (or .NET Core). C# is simple, powerful, type-safe, and object-oriented.', 1, '2021-07-19 07:26:36'),
(13, 'Data Structures', 'data-structures', 'A data structure is a way of organizing data in a fashion that allows particular properties of that data to be queried and/or updated efficiently. ', 1, '2021-07-19 07:26:36'),
(14, 'Ajax', 'ajax', 'AJAX (Asynchronous JavaScript and XML) is a technique for creating seamless interactive websites via asynchronous data exchange between client and server. AJAX facilitates communication with the server or partial page updates without a traditional page refresh.', 1, '2021-07-19 07:26:36'),
(15, 'Sql', 'sql', 'Structured Query Language (SQL) is a language for querying databases. Questions should include code examples, table structure, sample data, and a tag for the DBMS implementation (e.g. MySQL, PostgreSQL, Oracle, MS SQL Server, IBM DB2, etc.) being used. If your question relates solely to a specific DBMS (uses specific extensions/features), use that DBMS\'s tag instead. Answers to questions tagged with SQL should use ISO/IEC standard SQL.', 1, '2021-07-19 07:26:36'),
(16, 'Mongodb', 'mongodb', 'MongoDB is a scalable, high-performance, open source, document-oriented NoSQL database. It supports a large number of languages and application development platforms. Questions about server administration can be asked on http://dba.stackexchange.com.', 1, '2021-07-19 07:26:36'),
(17, 'Wordpress', 'wordpress', 'This tag is for programming-specific questions related to the content management system WordPress. Questions about theme development, WordPress administration, management best practices, and server configuration are off-topic here and best asked on Stack Exchange WordPress Development. ', 1, '2021-07-19 07:26:36'),
(18, 'Android', 'andriod', 'Android is Google\'s mobile operating system, used for programming or developing digital devices (Smartphones, Tablets, Automobiles, TVs, Wear, Glass, IoT). For topics related to Android, use Android-specific tags such as android-intent, not intent, android-activity, not activity, android-adapter, not adapter etc. For questions other than development or programming, but related to Android framework, use the link: https://android.stackexchange.com. ', 1, '2021-07-19 07:26:36'),
(19, 'C++', 'c++', 'C++ is a general-purpose programming language. It was originally designed as an extension to C, and keeps a similar syntax, but is now a completely different language. Use this tag for questions about code (to be) compiled with a C++ compiler. Use a version specific tag for questions related to a specific standard revision [C++11], [C++17], etc.', 1, '2021-07-19 07:26:36'),
(20, 'Python', 'python', 'Python is a dynamic, strongly typed, object-oriented, multipurpose programming language, designed to be quick (to learn, to use, and to understand), and to enforce a clean and uniform syntax. Two similar but incompatible versions of Python are in use (Python 2.7 or 3.x). For version-specific Python questions, please also use the [python-2.7] or [python-3.x] tags. When using a Python variant (Jython, Pypy, Iron-python, etc.) - please also tag the variant. ', 1, '2021-07-19 07:26:36'),
(21, 'AngularJS', 'angularjs', 'Use for questions about AngularJS (1.x), the open-source JavaScript framework. Do NOT use this tag for Angular 2 or later versions; instead, use the [angular] tag.', 1, '2021-07-19 07:26:36'),
(22, 'Node.js', 'node.js', 'Node.js is an event-based, non-blocking, asynchronous I/O framework that uses Google\'s V8 JavaScript engine and libuv library. It is used for developing applications that make heavy use of the ability to run JavaScript both on the client, as well as on server side and therefore benefit from the re-usability of code and the lack of context switching.', 1, '2021-07-19 07:26:36'),
(23, 'Swift', 'swift', 'Swift is a general-purpose, open-source programming language developed by Apple Inc. for their platforms and Linux. Use the tag only for questions about language features, or requiring code in Swift. Use the tags [ios], [osx], [watch-os], [tvos], [cocoa-touch], and [cocoa] for (language-agnostic) questions about the platforms or frameworks.', 1, '2021-07-19 07:26:36'),
(24, 'VB.Net', 'vb.net', 'Visual Basic.NET (VB.NET) is a multi-paradigm, managed, type-safe, object-oriented computer programming language. Along with C# and F#, it is one of the main languages targeting the .NET Framework. VB.NET can be viewed as an evolution of Microsoft\'s Visual Basic 6 (VB6) but implemented on the Microsoft .NET Framework. DO NOT USE this tag for VB6, VBA or VBScript questions.', 1, '2021-07-19 07:26:36'),
(25, 'ReactJs', 'reactjs', 'React is a JavaScript library for building user interfaces. It uses a declarative paradigm and aims to be both efficient and flexible.', 1, '2021-07-19 07:26:36'),
(26, 'Web Sockets', 'websocket', 'WebSocket is an API built on top of TCP sockets and a protocol for bi-directional, full-duplex communication between client and server without the overhead of HTTP.', 1, '2021-07-19 07:26:36'),
(27, 'Yii', 'yii', 'Use for questions about any version of Yii, an open-source MVC framework for writing web 2.0 applications in PHP5+', 1, '2021-07-19 07:26:36'),
(28, 'Cordova', 'cordova', 'Apache Cordova (formerly PhoneGap) is a framework that allows developers to create cross-platform mobile applications using web technologies like HTML, JavaScript, and CSS. ', 1, '2021-07-19 07:26:36'),
(29, 'iOS', 'ios', 'iOS is the mobile operating system running on the Apple iPhone, iPod touch, and iPad. Use this tag [ios] for questions related to programming on the iOS platform. Use the related tags [objective-c] and [swift] for issues specific to those programming languages.', 1, '2021-07-19 07:26:36'),
(30, 'Xamarin', 'xamarin', 'Xamarin is a platform consisting of Xamarin.iOS, Xamarin.Android, Xamarin.Mac and Xamarin Test Cloud. It allows you to write cross-platform native Apps for iOS, Android and Mac and follow your app through its entire lifecycle. The introduction of Xamarin.Forms supports Native UI development for iOS, Android and Windows ', 1, '2021-07-19 07:26:36'),
(31, 'Numpy', 'numpy', 'NumPy is a scientific and numerical computing extension to the Python programming language.', 1, '2021-07-19 07:26:36'),
(32, 'Jython', 'jython', 'Jython is an open-source implementation of the Python programming language in Java.', 1, '2021-07-19 07:26:36'),
(33, 'Scipy', 'scipy', 'SciPy is an open source library of algorithms and mathematical tools for the Python programming language.', 1, '2021-07-19 07:26:36'),
(34, 'ASP.Net Core', 'asp.netcore', 'ASP.NET Core is a lean, composable and cross-platform framework for building web and cloud applications. It is fully open source on GitHub. ASP.NET Core apps can be run on Windows with the full .NET Framework or smaller .NET Core, or on Linux and MacOS with .NET Core and Mono.', 1, '2021-07-19 07:26:36'),
(35, 'ASP.Net MVC', 'asp.netmvc', 'The ASP.NET MVC Framework is an open source web application framework and tooling that implements a version of the model-view-controller (MVC) pattern tailored towards web applications and built upon an ASP.NET technology foundation.', 1, '2021-07-19 07:26:36'),
(36, 'Linq', 'linq', 'Language Integrated Query (LINQ) is a Microsoft .NET Framework component that adds native data querying capabilities to .NET languages. Please consider using more detailed tags when appropriate, for example [linq-to-sql], [linq-to-entities] / [entity-framework], or [plinq]', 1, '2021-07-19 07:26:36'),
(37, 'XML', 'xml', 'Extensible Markup Language (XML) is a flexible, structured document format that defines human- and machine-readable encoding rules.', 1, '2021-07-19 07:26:36'),
(38, 'Drupal', 'drupal', 'Drupal is an open source CMS framework written in PHP. *IMPORTANT* Rather than using this tag, consider posting your question directly on https://drupal.stackexchange.com/. Also, because of substantial differences between major versions, consider using either the drupal-6, drupal-7 or drupal-8 tags.', 1, '2021-07-19 07:26:36'),
(39, 'Firebase', 'firebase', 'Firebase is a serverless platform for unified development of applications for mobile devices and for the Web.', 1, '2021-07-19 07:26:36'),
(40, 'Joomla', 'joomla', 'Joomla! is a free and open source Content Management System (CMS) for publishing content on the World Wide Web and intranets and a model–view–controller (MVC) Web application framework that can also be used independently. Joomla questions can also be asked on https://joomla.stackexchange.com/ ', 1, '2021-07-19 07:26:36'),
(41, 'Laravel', 'laravel', 'Laravel is an open-source PHP web framework, following the MVC pattern.', 1, '2021-07-19 07:26:36'),
(42, 'Shell', 'shell', 'The term \'shell\' refers to a general class of text-based interactive command interpreters most often associated with the Unix & Linux operating systems. For questions about shell scripting, please use a more specific tag such as \'bash\', \'powershell\' or \'ksh\'. Without a specific tag, a portable (POSIX-compliant) solution should be assumed, though using \'posix\' in addition or \'sh\' instead is preferable.', 1, '2021-07-19 07:26:36'),
(43, 'Nightwatch.js', 'nightwatch', 'Nightwatch.js is an easy to use Node.js based End-to-End (E2E) testing solution for browser based apps and websites.', 1, '2021-07-19 07:26:36'),
(44, 'API', 'api', 'DO NOT USE: Tag with the library you mean, [api-design], or something else appropriate instead. Questions asking us to recommend or find an API are off-topic.', 1, '2021-07-19 07:26:36'),
(45, 'Matlab', 'matlab', 'MATLAB is a high-level language and interactive programming environment for numerical computation and visualization developed by MathWorks. Questions should be tagged with either [tag:matlab] or [tag:octave], but not both, unless the question explicitly involves both packages. When using this tag, please mention the MATLAB release you\'re working with (e.g. R2017a).', 1, '2021-07-19 07:26:36'),
(46, 'NativeScript', 'nativescript', 'NativeScript is an open source framework created by Telerik that makes native mobile app development easier for web developers. It enables developers to use JavaScript or TypeScript (with or without Angular or Vue) to build native mobile applications for iOS and Android. NativeScript apps render native UI components styled by a subset of CSS. Modules provide cross-platform native API abstractions. 100% of native APIs are available via JavaScript.', 1, '2021-07-19 07:26:36'),
(47, 'spreadsheet', 'spreadsheet', 'Use this tag for questions about spreadsheet apps, plug-ins, libraries, etc., where no more specific tag exists. A spreadsheet presents tabular data sets arranged in rows and columns, typically with tools for capturing, analyzing, and collaborating on that data. Each cell may contain alphanumeric text, numeric values, or formulas. ', 1, '2021-07-19 07:26:36'),
(49, '.NET', 'visual-net', 'The .NET framework is a software framework designed mainly for the Microsoft Windows operating system. It includes an implementation of the Base Class Library, Common Language Runtime (commonly referred to as CLR), Common Type System (commonly referred to as CTS) and Dynamic Language Runtime. It supports many programming languages, including C#, VB.NET, F# and C++/CLI. Do NOT use for questions about .NET Core.', 1, '2021-07-19 07:26:36'),
(50, 'GIT', 'git', 'Git is an open-source distributed version control system (DVCS). Use this tag for questions related to Git usage and workflows. Do not use this tag for general programming questions that happen to involve a Git repository.', 1, '2021-07-19 07:26:36'),
(51, 'Algorithms', 'algorithms', 'An algorithm is a sequence of well-defined steps that defines an abstract solution to a problem. Use this tag when your issue is related to algorithm design.', 1, '2021-07-19 07:26:36'),
(52, 'Action Script', 'action-script', 'ActionScript is a scripting language used to create Rich Internet Applications (RIA), mobiles applications, web applications, etc. It is the main language for Flash and Flex.', 1, '2021-07-19 07:26:36'),
(54, 'Rest Apis', 'rest-api', 'A RESTful API is an application program interface (API) that uses HTTP requests to GET, PUT, POST and DELETE data.', 1, '2021-07-19 07:26:36'),
(55, 'Type Script', 'type-script', 'TypeScript is a typed superset of JavaScript created by Microsoft that adds optional types, classes, async/await, and many other features, and compiles to plain JavaScript. This tag is for questions specific to TypeScript. It is not used for general JavaScript questions.', 1, '2021-07-19 07:26:36'),
(56, 'Bash Script', 'bash-script', 'For questions about scripts written for the Bash command shell. For shell scripts with errors, please check them with the shellcheck program (or in the web shellcheck server at https://shellcheck.net) before posting here. Questions about interactive use of Bash are more likely to be on-topic on Super User than on Stack Overflow.', 1, '2021-07-19 07:26:36'),
(57, 'Linux', 'linux', 'LINUX QUESTIONS MUST BE PROGRAMMING RELATED. Use this tag only if your question relates to programming using Linux APIs or Linux-specific behavior, not just because you happen to run your code on Linux. If you need Linux support you can try https://unix.stackexchange.com or https://askubuntu.com', 1, '2021-07-19 07:26:36'),
(58, 'Mysql', 'mysql', 'MySQL is a free, open source Relational Database Management System (RDBMS) that uses Structured Query Language (SQL). DO NOT USE this tag for other DBs such as SQL Server, SQLite etc. These are different DBs which all use SQL to manage the data.', 1, '2021-07-19 07:26:36'),
(59, 'Docker', 'docker', 'Docker provides a high-level API to containerize processes and applications with some degree of isolation and repeatability across servers. Docker supports both Linux and Windows containers.', 1, '2021-07-19 07:26:36'),
(60, 'GitHub', 'github', 'GitHub is a web-based hosting service for software development projects that use Git for version control. Use this tag for questions specific to problems with repositories hosted on GitHub, features specific to GitHub and using GitHub for collaborating with other users. Do not use this tag for Git-related issues simply because a repository happens to be hosted on GitHub.', 1, '2021-07-19 07:26:36'),
(61, 'Ruby', 'ruby', '', 1, '2021-07-19 07:26:36'),
(62, 'Flash', 'flash', 'For questions on Adobe\'s cross-platform multimedia runtime used to embed animations, video, and interactive applications into web pages. For questions related to memory, use the tag [flash-memory].', 1, '2021-07-19 07:26:36'),
(63, 'UNIX', 'unix', 'The Unix operating system is a general purpose OS that was developed by Bell Labs in the late 1960s and today exists in various versions. Important note: This tag is exclusively for programming questions that are directly related to Unix; general software issues should be directed to the Unix & Linux Stack Exchange site or to Super User.', 1, '2021-07-19 07:26:36'),
(65, 'R', 'r', 'R is a free, open-source programming language and software environment for statistical computing, bioinformatics, visualization and general computing. Provide minimal, reproducible, representative example(s) with your questions. Use dput() for data and specify all non-base packages with library calls. Do not embed pictures for data or code, use indented code blocks.', 1, '2021-07-19 07:26:36'),
(66, 'Math', 'math', 'Mathematics is the study of quantity, structure, space, and change. Any math questions on this site should be programming related.', 1, '2021-07-19 07:26:36'),
(67, 'Editor', 'editor', 'This tag is for questions about the features and functionality of text editors, source code editors and other programs specifically designed for modifying plain text files used in computer programming. Questions asking us to recommend or find an editor are strictly off-topic. ', 1, '2021-07-19 07:26:36'),
(68, 'Assembly', 'Assembly', 'Assembly language (asm) programming questions. BE SURE TO ALSO TAG with the processor and/or instruction set you\'re using, as well as the assembler. WARNING: For .NET assemblies, use the tag [.net-assembly] instead. For Java ASM, use the tag [java-bytecode-asm] instead.', 1, '2021-07-19 07:26:36'),
(85, 'Other', 'other', 'This tag is for questions on multiple areas that are not listed. Questions asking us to recommend or find an editor are completely off topic.', 1, '2021-07-19 07:26:36');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `editedQuestionsList`
--

DROP TABLE IF EXISTS `editedQuestionsList`;
CREATE TABLE `editedQuestionsList` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `editedQuestionsList`
--

INSERT INTO `editedQuestionsList` (`id`, `qid`, `userid`, `on`) VALUES
(1, 106, 101, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `home`
--

DROP TABLE IF EXISTS `home`;
CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `home`
--

INSERT INTO `home` (`id`, `name`, `code`, `value`) VALUES
(1, 'Section 1 Title', 'section1_title', 'International Q&A forum BlackExpo platform'),
(2, 'Section 1 Sub', 'section1_sub', 'This is just a simple text made for this unique and awesome template, you can replace it with any text.'),
(3, 'Section 2 Title 1', 'section2_title1', '80M+'),
(4, 'Section 2 Sub 1', 'section2_sub1', 'Monthly visitors to our network'),
(5, 'Section 2 Title 2', 'section2_title2', '25M+'),
(6, 'Section 2 Sub 2', 'section2_sub2', 'Questions asked to-date'),
(7, 'Section 2 Title 3', 'section2_title3', '60 seconds'),
(8, 'Section 2 Sub 3', 'section2_sub3', 'Average time between new questions'),
(9, 'Section 2 Title 4', 'section2_title4', '40M+'),
(10, 'Section 2 Sub 4', 'section2_sub4', 'Times a developer got help'),
(11, 'Section 2 Title 5', 'section2_title5', '10k+'),
(12, 'Section 2 Sub 5', 'section2_sub5', 'Customer companies for all products'),
(13, 'Section 4 Title', 'section4_title', 'For developers, by developers'),
(14, 'Section 4 Sub', 'section4_sub', 'This is an open community for anyone to code. We help you answer your most difficult programming questions, share and learn with everyone in the world.'),
(15, 'Section 4 Item 1 Title', 'section4_item1_title', 'Public Q&A'),
(16, 'Section 4 Item 1 sub', 'section4_item1_sub', 'This is just a simple text made for this unique and awesome template, you can easily edit it as you want.'),
(17, 'Section 4 Item 2 Title', 'section4_item2_title', 'Badges'),
(18, 'Section 4 Item 2 sub', 'section4_item2_sub', 'This is just a simple text made for this unique and awesome template, you can easily edit it as you want.'),
(19, 'Section 4 Item 3 Title', 'section4_item3_title', 'Browse Users'),
(20, 'Section 4 Item 3 sub', 'section4_item3_sub', 'This is just a simple text made for this unique and awesome template, you can easily edit it as you want.'),
(21, 'Section 6 Title', 'section6_title', 'Q&A communities are different. Here\'s how'),
(22, 'Section 6 Title', 'section6_item1_title', 'Expert communities.'),
(23, 'Section 6 Item 1 sub', 'section6_item1_sub', 'Each of our 177 communities is built by people passionate about a focused topic.'),
(24, 'Section 6 Item 2 Title', 'section6_item2_title', 'The right answer. Right on top.'),
(25, 'Section 6 Item 2 sub', 'section6_item2_sub', 'Experts like you can vote on posts, so the most helpful answers are easy to find.'),
(26, 'Section 6 Item 3 Title', 'section6_item3_title', 'Share knowledge. Earn trust.'),
(27, 'Section 6 Item 3 sub', 'section6_item3_sub', 'Earn reputation and additional privileges for posts others find helpful.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Jobs`
--

DROP TABLE IF EXISTS `Jobs`;
CREATE TABLE `Jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_permalink` varchar(200) NOT NULL,
  `job_category` varchar(20) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `job_type` varchar(20) NOT NULL,
  `job_experience` varchar(20) NOT NULL,
  `technologies` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `salary` varchar(20) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `companylocation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(755) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_seo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_seo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `details`, `image`, `slug`, `title_seo`, `description_seo`, `created_at`, `updated_at`) VALUES
(1, 'Open space – new trend in office design Managing Projects', 'We want to make it easier to learn more about a question and highlight key facts about it — such as how popular the question is, how many people are interested in it, and who the audience is', '<p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">We want to make it easier to learn more about a question and highlight key facts about it — such as how popular the question is, how many people are interested in it, and who the audience is. To accomplish that, today we’re introducing Question Overview, a new section on the question page that will make it easier to find the most important information about a question and its audience.</p><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum.</p><h4 class=\"pb-3 fs-22\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; font-weight: 500; line-height: 1.2; color: rgb(13, 35, 62); font-family: Ubuntu, sans-serif; padding-bottom: 1rem !important; font-size: 22px !important;\">Some real life examples</h4><div class=\"row\" style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; display: flex; flex-wrap: wrap; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif;\"><div class=\"col-lg-6\" style=\"padding-top: 0px; padding-bottom: 0px; margin: 0px; width: 401.062px; flex: 0 0 50%; max-width: 50%;\"><a href=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img6.jpg\" class=\"gallery-item overflow-hidden mb-4\" data-fancybox=\"gallery\" style=\"padding: 0px; margin: 0px 0px 10px; color: rgb(0, 123, 255); overflow: hidden; display: block; border-radius: 4px;\"><img class=\"lazy\" src=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img6.jpg\" alt=\"review image\" style=\"padding: 0px; margin: 0px; border-style: none; border-radius: 4px; transition: all 0.3s ease 0s; width: 371.062px;\"></a></div><div class=\"col-lg-6\" style=\"padding-top: 0px; padding-bottom: 0px; margin: 0px; width: 401.062px; flex: 0 0 50%; max-width: 50%;\"><a href=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img7.jpg\" class=\"gallery-item overflow-hidden mb-4\" data-fancybox=\"gallery\" style=\"padding: 0px; margin: 0px 0px 10px; color: rgb(0, 123, 255); overflow: hidden; display: block; border-radius: 4px;\"><img class=\"lazy\" src=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img7.jpg\" alt=\"review image\" style=\"padding: 0px; margin: 0px; border-style: none; border-radius: 4px; transition: all 0.3s ease 0s; width: 371.062px;\"></a></div></div><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p><blockquote class=\"blockquote blockquote-box my-4\" style=\"padding-top: 0px; padding-right: 0px; padding-bottom: 0px; font-size: 1.25rem; border-left-width: 7px; border-left-color: rgba(128, 137, 150, 0.2); position: relative; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;\"><span class=\"la la-quote-right\" style=\"padding: 0px; margin: 0px; -webkit-font-smoothing: antialiased; display: inline-block; font-variant-numeric: normal; font-variant-east-asian: normal; text-rendering: auto; line-height: 1; font-family: &quot;Line Awesome Free&quot;; font-weight: 900; position: absolute; bottom: 10px; right: 5px; font-size: 50px; opacity: 0.2;\"></span><p class=\"pb-2\" style=\"padding-top: 0px; padding-right: 30px; padding-left: 0px; margin-bottom: 0px; font-style: italic; font-size: 16px; padding-bottom: 0.5rem !important;\">Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla.</p><footer class=\"blockquote-footer\" style=\"padding: 0px; margin: 0px; font-size: 16px; color: rgb(108, 117, 125);\">Someone famous in&nbsp;<cite title=\"Source Title\" style=\"padding: 0px; margin: 0px;\">Source Title</cite></footer></blockquote><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', '1630484363.jpeg', 'open-space-new-trend-in-office-design-managing-projects', NULL, '', '2021-09-01 08:18:21', '2021-09-01 08:20:25'),
(2, 'What You Can Learn About Managing Projects', 'We want to make it easier to learn more about a question and highlight key facts about it — such as how popular the question is, how many people are interested in it, and who the audience is', '<p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">We want to make it easier to learn more about a question and highlight key facts about it — such as how popular the question is, how many people are interested in it, and who the audience is. To accomplish that, today we’re introducing Question Overview, a new section on the question page that will make it easier to find the most important information about a question and its audience.</p><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum.</p><h4 class=\"pb-3 fs-22\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; font-weight: 500; line-height: 1.2; color: rgb(13, 35, 62); font-family: Ubuntu, sans-serif; padding-bottom: 1rem !important; font-size: 22px !important;\">Some real life examples</h4><div class=\"row\" style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; display: flex; flex-wrap: wrap; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif;\"><div class=\"col-lg-6\" style=\"padding-top: 0px; padding-bottom: 0px; margin: 0px; width: 401.062px; flex: 0 0 50%; max-width: 50%;\"><a href=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img6.jpg\" class=\"gallery-item overflow-hidden mb-4\" data-fancybox=\"gallery\" style=\"padding: 0px; margin: 0px 0px 10px; color: rgb(0, 123, 255); overflow: hidden; display: block; border-radius: 4px;\"><img class=\"lazy\" src=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img6.jpg\" alt=\"review image\" style=\"padding: 0px; margin: 0px; border-style: none; border-radius: 4px; transition: all 0.3s ease 0s; width: 371.062px;\"></a></div><div class=\"col-lg-6\" style=\"padding-top: 0px; padding-bottom: 0px; margin: 0px; width: 401.062px; flex: 0 0 50%; max-width: 50%;\"><a href=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img7.jpg\" class=\"gallery-item overflow-hidden mb-4\" data-fancybox=\"gallery\" style=\"padding: 0px; margin: 0px 0px 10px; color: rgb(0, 123, 255); overflow: hidden; display: block; border-radius: 4px;\"><img class=\"lazy\" src=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img7.jpg\" alt=\"review image\" style=\"padding: 0px; margin: 0px; border-style: none; border-radius: 4px; transition: all 0.3s ease 0s; width: 371.062px;\"></a></div></div><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p><blockquote class=\"blockquote blockquote-box my-4\" style=\"padding-top: 0px; padding-right: 0px; padding-bottom: 0px; font-size: 1.25rem; border-left-width: 7px; border-left-color: rgba(128, 137, 150, 0.2); position: relative; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;\"><span class=\"la la-quote-right\" style=\"padding: 0px; margin: 0px; -webkit-font-smoothing: antialiased; display: inline-block; font-variant-numeric: normal; font-variant-east-asian: normal; text-rendering: auto; line-height: 1; font-family: &quot;Line Awesome Free&quot;; font-weight: 900; position: absolute; bottom: 10px; right: 5px; font-size: 50px; opacity: 0.2;\"></span><p class=\"pb-2\" style=\"padding-top: 0px; padding-right: 30px; padding-left: 0px; margin-bottom: 0px; font-style: italic; font-size: 16px; padding-bottom: 0.5rem !important;\">Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla.</p><footer class=\"blockquote-footer\" style=\"padding: 0px; margin: 0px; font-size: 16px; color: rgb(108, 117, 125);\">Someone famous in&nbsp;<cite title=\"Source Title\" style=\"padding: 0px; margin: 0px;\">Source Title</cite></footer></blockquote><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', '1630484336.jpeg', 'what-you-can-learn-about-managing-projects', NULL, '', '2021-09-01 08:18:21', '2021-09-01 08:19:07'),
(3, 'Designers should always keep their users in mind', 'We want to make it easier to learn more about a question and highlight key facts about it — such as how popular the question is, how many people are interested in it, and who the audience is', '<p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">We want to make it easier to learn more about a question and highlight key facts about it — such as how popular the question is, how many people are interested in it, and who the audience is. To accomplish that, today we’re introducing Question Overview, a new section on the question page that will make it easier to find the most important information about a question and its audience.</p><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum.</p><h4 class=\"pb-3 fs-22\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; font-weight: 500; line-height: 1.2; color: rgb(13, 35, 62); font-family: Ubuntu, sans-serif; padding-bottom: 1rem !important; font-size: 22px !important;\">Some real life examples</h4><div class=\"row\" style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; display: flex; flex-wrap: wrap; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif;\"><div class=\"col-lg-6\" style=\"padding-top: 0px; padding-bottom: 0px; margin: 0px; width: 401.062px; flex: 0 0 50%; max-width: 50%;\"><a href=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img6.jpg\" class=\"gallery-item overflow-hidden mb-4\" data-fancybox=\"gallery\" style=\"padding: 0px; margin: 0px 0px 10px; color: rgb(0, 123, 255); overflow: hidden; display: block; border-radius: 4px;\"><img class=\"lazy\" src=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img6.jpg\" alt=\"review image\" style=\"padding: 0px; margin: 0px; border-style: none; border-radius: 4px; transition: all 0.3s ease 0s; width: 371.062px;\"></a></div><div class=\"col-lg-6\" style=\"padding-top: 0px; padding-bottom: 0px; margin: 0px; width: 401.062px; flex: 0 0 50%; max-width: 50%;\"><a href=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img7.jpg\" class=\"gallery-item overflow-hidden mb-4\" data-fancybox=\"gallery\" style=\"padding: 0px; margin: 0px 0px 10px; color: rgb(0, 123, 255); overflow: hidden; display: block; border-radius: 4px;\"><img class=\"lazy\" src=\"http://techydevs.com/demos/themes/html/disilab-demo/disilab/images/img7.jpg\" alt=\"review image\" style=\"padding: 0px; margin: 0px; border-style: none; border-radius: 4px; transition: all 0.3s ease 0s; width: 371.062px;\"></a></div></div><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p><blockquote class=\"blockquote blockquote-box my-4\" style=\"padding-top: 0px; padding-right: 0px; padding-bottom: 0px; font-size: 1.25rem; border-left-width: 7px; border-left-color: rgba(128, 137, 150, 0.2); position: relative; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;\"><span class=\"la la-quote-right\" style=\"padding: 0px; margin: 0px; -webkit-font-smoothing: antialiased; display: inline-block; font-variant-numeric: normal; font-variant-east-asian: normal; text-rendering: auto; line-height: 1; font-family: &quot;Line Awesome Free&quot;; font-weight: 900; position: absolute; bottom: 10px; right: 5px; font-size: 50px; opacity: 0.2;\"></span><p class=\"pb-2\" style=\"padding-top: 0px; padding-right: 30px; padding-left: 0px; margin-bottom: 0px; font-style: italic; font-size: 16px; padding-bottom: 0.5rem !important;\">Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla.</p><footer class=\"blockquote-footer\" style=\"padding: 0px; margin: 0px; font-size: 16px; color: rgb(108, 117, 125);\">Someone famous in&nbsp;<cite title=\"Source Title\" style=\"padding: 0px; margin: 0px;\">Source Title</cite></footer></blockquote><p class=\"card-text pb-3\" style=\"padding-top: 0px; padding-right: 0px; padding-left: 0px; margin-bottom: 0px; color: rgb(108, 114, 124); font-family: Ubuntu, sans-serif; font-size: 16px; padding-bottom: 1rem !important;\">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>', '1630484301.jpeg', 'designers-should-always-keep-their-users-in-mind', NULL, '', '2021-09-01 08:18:21', '2021-09-01 08:18:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `nsId` int(11) NOT NULL,
  `for` int(11) NOT NULL,
  `by` int(11) DEFAULT NULL,
  `qid` int(11) DEFAULT NULL,
  `qaid` int(11) DEFAULT NULL,
  `qrid` int(11) DEFAULT NULL,
  `arid` int(11) DEFAULT NULL,
  `badgeId` int(11) DEFAULT NULL,
  `repId` int(11) DEFAULT NULL,
  `read` int(10) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `nsId`, `for`, `by`, `qid`, `qaid`, `qrid`, `arid`, `badgeId`, `repId`, `read`, `on`) VALUES
(1, 1, 68, 101, 415, 7797, NULL, NULL, NULL, NULL, 0, '2021-09-08 22:42:11'),
(2, 1, 1, 1, 1, 1, NULL, NULL, NULL, NULL, 0, '2021-09-10 15:49:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notificationSchema`
--

DROP TABLE IF EXISTS `notificationSchema`;
CREATE TABLE `notificationSchema` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `notificationSchema`
--

INSERT INTO `notificationSchema` (`id`, `title`, `description`, `permalink`, `on`) VALUES
(1, 'Received an answer on your question', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:06:35'),
(2, 'Received a reply on your question', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:07:30'),
(3, 'Received a reply on your answer', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:07:58'),
(4, 'Your question was edited', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:13:48'),
(5, 'Your question was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:12'),
(6, 'Your answer was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:24'),
(7, 'Your answer reply was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:56'),
(8, 'Your question reply was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:15:17'),
(9, 'Your question reply was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:15:33'),
(10, 'Your answer reply was reported', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:15:39'),
(11, 'Badge received', 'You received a badge (badgeName)', 'profile/(userid)', '2018-08-28 07:16:56'),
(12, 'Reputation Change', 'You earned a reputation (reputation)', 'profile/(userid)', '2018-08-28 07:17:58'),
(13, 'Your question was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:40:04'),
(14, 'Your answer was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:40:04'),
(15, 'Your answer reply was voted', '(questionName)', 'questions/(questionId)/(questionPerma)', '2018-08-28 07:14:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `title`, `details`, `sort`, `slug`, `local`, `created_at`, `updated_at`) VALUES
(4, 'Contact Us', '<h1 style=\"margin-top: 20px; margin-bottom: 20px; padding: 0px; color: rgb(85, 85, 85); font-size: 24px; line-height: 40px; font-weight: 500; font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\"><span style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Orci nulla pellentesque dignissim enim sit. Pellentesque nec nam aliquam sem et tortor consequat id. Nisl tincidunt eget nullam non nisi. Eget velit aliquet sagittis id consectetur purus ut faucibus. Magna fermentum iaculis eu non diam phasellus vestibulum. Eleifend donec pretium vulputate sapien. Faucibus et molestie ac feugiat sed. Lacus sed viverra tellus in hac habitasse platea dictumst vestibulum. Id aliquet risus feugiat in. In nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Quisque non tellus orci ac auctor augue mauris. Ornare suspendisse sed nisi lacus sed.</span><br></h1>', 3, 'contact-us', 'en', '2019-10-31 14:13:50', '2021-09-10 08:26:33'),
(14, 'About Us', '<div><p>Lorem\r\n ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod \r\ntempor incididunt ut labore et dolore magna aliqua. Orci nulla \r\npellentesque dignissim enim sit. Pellentesque nec nam aliquam sem et \r\ntortor consequat id. Nisl tincidunt eget nullam non nisi. Eget velit \r\naliquet sagittis id consectetur purus ut faucibus. Magna fermentum \r\niaculis eu non diam phasellus vestibulum. Eleifend donec pretium \r\nvulputate sapien. Faucibus et molestie ac feugiat sed. Lacus sed viverra\r\n tellus in hac habitasse platea dictumst vestibulum. Id aliquet risus \r\nfeugiat in. In nulla posuere sollicitudin aliquam ultrices sagittis orci\r\n a scelerisque. Quisque non tellus orci ac auctor augue mauris. Ornare \r\nsuspendisse sed nisi lacus sed.</p>\r\n<p>Nulla porttitor massa id neque aliquam vestibulum morbi blandit. \r\nVivamus at augue eget arcu. Eget nunc scelerisque viverra mauris in \r\naliquam sem fringilla. Risus nullam eget felis eget nunc lobortis. \r\nLibero enim sed faucibus turpis in. Scelerisque in dictum non \r\nconsectetur a. Habitant morbi tristique senectus et netus et malesuada \r\nfames. Nulla aliquet porttitor lacus luctus accumsan tortor. Faucibus et\r\n molestie ac feugiat. Turpis massa sed elementum tempus egestas sed. \r\nSemper auctor neque vitae tempus. Sapien pellentesque habitant morbi \r\ntristique senectus. Non nisi est sit amet facilisis. Est lorem ipsum \r\ndolor sit amet consectetur adipiscing elit pellentesque. Diam quis enim \r\nlobortis scelerisque fermentum dui faucibus in ornare. Lorem ipsum dolor\r\n sit amet consectetur adipiscing elit.</p>\r\n<p>Nunc sed id semper risus in hendrerit gravida. Tellus id interdum \r\nvelit laoreet. Congue mauris rhoncus aenean vel elit scelerisque mauris \r\npellentesque. Nunc vel risus commodo viverra maecenas accumsan lacus vel\r\n facilisis. Donec et odio pellentesque diam volutpat. Nunc vel risus \r\ncommodo viverra maecenas accumsan lacus vel facilisis. Amet volutpat \r\nconsequat mauris nunc congue nisi vitae suscipit tellus. Etiam sit amet \r\nnisl purus in mollis nunc sed id. Et leo duis ut diam quam nulla. Sem \r\nviverra aliquet eget sit amet tellus cras adipiscing enim.</p></div>', 0, 'about-us', 'en', '2019-11-15 20:15:08', '2021-08-14 01:21:35'),
(15, 'Terms of Service', '<p style=\"margin-bottom: 0px; padding: 0px; line-height: 30px; font-size: 16px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\"><span style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Orci nulla pellentesque dignissim enim sit. Pellentesque nec nam aliquam sem et tortor consequat id. Nisl tincidunt eget nullam non nisi. Eget velit aliquet sagittis id consectetur purus ut faucibus. Magna fermentum iaculis eu non diam phasellus vestibulum. Eleifend donec pretium vulputate sapien. Faucibus et molestie ac feugiat sed. Lacus sed viverra tellus in hac habitasse platea dictumst vestibulum. Id aliquet risus feugiat in. In nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Quisque non tellus orci ac auctor augue mauris. Ornare suspendisse sed nisi lacus sed.</span><br></p>', 1, 'terms-of-service', 'en', '2019-11-21 20:51:11', '2021-09-10 08:26:13'),
(16, 'Privacy Policy', '<p style=\"margin-bottom: 0px; padding: 0px; line-height: 30px; font-size: 16px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\"><span style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Orci nulla pellentesque dignissim enim sit. Pellentesque nec nam aliquam sem et tortor consequat id. Nisl tincidunt eget nullam non nisi. Eget velit aliquet sagittis id consectetur purus ut faucibus. Magna fermentum iaculis eu non diam phasellus vestibulum. Eleifend donec pretium vulputate sapien. Faucibus et molestie ac feugiat sed. Lacus sed viverra tellus in hac habitasse platea dictumst vestibulum. Id aliquet risus feugiat in. In nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Quisque non tellus orci ac auctor augue mauris. Ornare suspendisse sed nisi lacus sed.</span><br></p>', 2, 'privacy-policy', 'en', '2019-11-21 20:51:44', '2021-09-10 08:26:25'),
(19, 'DMCA Copyright Infringement Notification', '<p style=\"margin-bottom: 0px; padding: 0px; line-height: 30px; font-size: 16px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\"><span style=\"color: rgb(51, 51, 51); font-family: Roboto, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Orci nulla pellentesque dignissim enim sit. Pellentesque nec nam aliquam sem et tortor consequat id. Nisl tincidunt eget nullam non nisi. Eget velit aliquet sagittis id consectetur purus ut faucibus. Magna fermentum iaculis eu non diam phasellus vestibulum. Eleifend donec pretium vulputate sapien. Faucibus et molestie ac feugiat sed. Lacus sed viverra tellus in hac habitasse platea dictumst vestibulum. Id aliquet risus feugiat in. In nulla posuere sollicitudin aliquam ultrices sagittis orci a scelerisque. Quisque non tellus orci ac auctor augue mauris. Ornare suspendisse sed nisi lacus sed.</span><br></p>', 4, 'dmca-copyright-infringement-notification', 'en', '2021-03-31 02:15:04', '2021-09-10 08:26:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `permalink` varchar(255) NOT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `votes` int(11) NOT NULL,
  `awnsers` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp(),
  `onDate` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `userid`, `catid`, `title`, `permalink`, `tags`, `description`, `votes`, `awnsers`, `views`, `on`, `onDate`, `status`) VALUES
(1, 1, 4, 'Unable to get data attribute from button element via Jquery', 'unable-to-get-data-attribute-from-button-element-via-jquery', 'jquery,javascript,html', '&lt;p&gt;I&amp;#39;m not able to get the data attribute from a button element.&amp;nbsp;I&amp;#39;m not able to get the data attribute from a button element.&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;&amp;lt;button\n class=&amp;quot;btn btn-solid navigate&amp;quot;\n value=&amp;quot;2&amp;quot;\n data-productId={{$product-&amp;gt;id}}\n id=&amp;quot;size-click&amp;quot;\n &amp;gt;\n Next\n&amp;lt;/button&amp;gt;\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;Then I attempt to get it like so:&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;$(&amp;quot;#size-click&amp;quot;).click(() =&amp;gt; {\n let width = $(&amp;quot;#prod-width&amp;quot;).val();\n let height = $(&amp;quot;#prod-height&amp;quot;).val();\n var prodId = $(this).data(&amp;quot;productId&amp;quot;);\n\n console.log(&amp;#39;this is prodId&amp;#39;);\n console.log(prodId);\n\n const data = {\n      prodId: prodId,\n      step: &amp;#39;Size&amp;#39;,\n      width: width,\n      height: height,\n    }\n\n    postDataEstimate(data);\n\n  })\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;I&amp;#39;m also trying this:&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;var prodId = $(this).attr(&amp;#39;data-productId&amp;#39;);\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;Can you let me know what I&amp;#39;m missing?&lt;/p&gt;', 0, 1, 1, '2021-09-10 15:49:03', '0000-00-00', 1),
(2, 1, 1, 'Bootstrap select pass value with disabled', 'bootstrap-select-pass-value-with-disabled', 'Bootstrap,javascript,html,web', '&lt;p&gt;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.&lt;/p&gt;\n\n&lt;p&gt;I&amp;#39;m not able to get the data attribute from a button element.&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;&amp;lt;button\n class=&amp;quot;btn btn-solid navigate&amp;quot;\n value=&amp;quot;2&amp;quot;\n data-productId={{$product-&amp;gt;id}}\n id=&amp;quot;size-click&amp;quot;\n &amp;gt;\n Next\n&amp;lt;/button&amp;gt;\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;Then I attempt to get it like so:&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;$(&amp;quot;#size-click&amp;quot;).click(() =&amp;gt; {\n let width = $(&amp;quot;#prod-width&amp;quot;).val();\n let height = $(&amp;quot;#prod-height&amp;quot;).val();\n var prodId = $(this).data(&amp;quot;productId&amp;quot;);\n\n console.log(&amp;#39;this is prodId&amp;#39;);\n console.log(prodId);\n\n const data = {\n      prodId: prodId,\n      step: &amp;#39;Size&amp;#39;,\n      width: width,\n      height: height,\n    }\n\n    postDataEstimate(data);\n\n  })\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;I&amp;#39;m also trying this:&lt;/p&gt;\n\n&lt;pre&gt;\n&lt;code&gt;var prodId = $(this).attr(&amp;#39;data-productId&amp;#39;);\n&lt;/code&gt;&lt;/pre&gt;\n\n&lt;p&gt;Can you let me know what I&amp;#39;m missing?&lt;/p&gt;', 0, 0, 1, '2021-09-10 15:50:59', '0000-00-00', 1),
(3, 1, 1, 'Bootstrap select pass value with disabled', 'bootstrap-select-pass-value-with-disabled-1', 'Bootstrap,javascript,html,web', '&lt;p&gt;It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.&lt;/p&gt;\r\n\r\n&lt;p&gt;I&amp;#39;m not able to get the data attribute from a button element.&lt;/p&gt;\r\n\r\n&lt;pre&gt;\r\n&lt;code&gt;&amp;lt;button\r\n class=&amp;quot;btn btn-solid navigate&amp;quot;\r\n value=&amp;quot;2&amp;quot;\r\n data-productId={{$product-&amp;gt;id}}\r\n id=&amp;quot;size-click&amp;quot;\r\n &amp;gt;\r\n Next\r\n&amp;lt;/button&amp;gt;\r\n&lt;/code&gt;&lt;/pre&gt;\r\n\r\n&lt;p&gt;Then I attempt to get it like so:&lt;/p&gt;\r\n\r\n&lt;pre&gt;\r\n&lt;code&gt;$(&amp;quot;#size-click&amp;quot;).click(() =&amp;gt; {\r\n let width = $(&amp;quot;#prod-width&amp;quot;).val();\r\n let height = $(&amp;quot;#prod-height&amp;quot;).val();\r\n var prodId = $(this).data(&amp;quot;productId&amp;quot;);\r\n\r\n console.log(&amp;#39;this is prodId&amp;#39;);\r\n console.log(prodId);\r\n\r\n const data = {\r\n      prodId: prodId,\r\n      step: &amp;#39;Size&amp;#39;,\r\n      width: width,\r\n      height: height,\r\n    }\r\n\r\n    postDataEstimate(data);\r\n\r\n  })\r\n&lt;/code&gt;&lt;/pre&gt;\r\n\r\n&lt;p&gt;I&amp;#39;m also trying this:&lt;/p&gt;\r\n\r\n&lt;pre&gt;\r\n&lt;code&gt;var prodId = $(this).attr(&amp;#39;data-productId&amp;#39;);\r\n&lt;/code&gt;&lt;/pre&gt;\r\n\r\n&lt;p&gt;Can you let me know what I&amp;#39;m missing?&lt;/p&gt;', 0, 0, 2, '2021-09-10 15:50:59', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questionSchema`
--

DROP TABLE IF EXISTS `questionSchema`;
CREATE TABLE `questionSchema` (
  `canVoteAfter` int(11) NOT NULL,
  `canReplyAfter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `questionSchema`
--

INSERT INTO `questionSchema` (`canVoteAfter`, `canReplyAfter`) VALUES
(15, 50);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questionsReplies`
--

DROP TABLE IF EXISTS `questionsReplies`;
CREATE TABLE `questionsReplies` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `userid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reportedAnswers`
--

DROP TABLE IF EXISTS `reportedAnswers`;
CREATE TABLE `reportedAnswers` (
  `id` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rsid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reportedQuestions`
--

DROP TABLE IF EXISTS `reportedQuestions`;
CREATE TABLE `reportedQuestions` (
  `id` int(11) NOT NULL,
  `qid` int(11) DEFAULT NULL,
  `rsid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reportSchema`
--

DROP TABLE IF EXISTS `reportSchema`;
CREATE TABLE `reportSchema` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `reportSchema`
--

INSERT INTO `reportSchema` (`id`, `name`, `description`, `on`, `status`) VALUES
(1, 'Inappropriate', 'This is just inappropriate to me, that is why I m reporting it.', '2018-07-24 07:30:49', 1),
(2, 'Invalid', 'This is just invalid.', '2018-07-24 07:31:11', 1),
(3, 'Copyright', 'This has a copyrighted content.', '2018-07-24 07:31:44', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reputationRecord`
--

DROP TABLE IF EXISTS `reputationRecord`;
CREATE TABLE `reputationRecord` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `reputation` int(11) NOT NULL,
  `on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'site_title', 'Blackexpo - Webdev International Forum'),
(2, 'facebook', '#'),
(3, 'twitter', '#'),
(5, 'site_description', 'Blackexpo questions and answers platform on Concept of Stackoverflow. Webdev international forum.'),
(6, 'before_head_tag', ''),
(7, 'after_head_tag', ''),
(8, 'before_body_end_tag', ''),
(11, 'time_before_redirect', '10'),
(13, 'default_country', 'VN'),
(14, 'default_language', 'vi'),
(21, 'screenshot_save', '0'),
(23, 'search_in', 'play'),
(26, 'google', '#'),
(27, 'instagram', '#'),
(28, 'fbAppId', ''),
(29, 'fbAppSecet', ''),
(30, 'googleAppId', ''),
(31, 'googleAppSecret', ''),
(32, 'imgurClientId', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'default-user-image.png',
  `title` varchar(30) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `instagram` varchar(200) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `googleplus` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `votes` int(11) DEFAULT 0,
  `voted` int(11) DEFAULT 0,
  `badgesGold` int(11) DEFAULT 0,
  `badgesSilver` int(11) DEFAULT 0,
  `badgesBronze` int(11) DEFAULT 0,
  `peopleReached` int(11) DEFAULT 0,
  `views` int(11) DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 1,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `badgesUpdateQ` datetime NOT NULL DEFAULT current_timestamp(),
  `badgesUpdateA` datetime NOT NULL DEFAULT current_timestamp(),
  `badgesUpdateP` datetime NOT NULL DEFAULT current_timestamp(),
  `reputationUpdate` datetime NOT NULL DEFAULT current_timestamp(),
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `image`, `title`, `description`, `website`, `location`, `twitter`, `instagram`, `password`, `remember_token`, `facebook`, `googleplus`, `status`, `votes`, `voted`, `badgesGold`, `badgesSilver`, `badgesBronze`, `peopleReached`, `views`, `role`, `google_id`, `facebook_id`, `badgesUpdateQ`, `badgesUpdateA`, `badgesUpdateP`, `reputationUpdate`, `on`) VALUES
(1, 'user@gmail.com', 'Rendy', 'default-user-image.png', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$AIYskwA.E04r5uNSqyZXAu.nU27Jwo5Gn.84S562r5pzkeSPBaNHS', NULL, NULL, NULL, 1, 0, 0, 0, 0, 0, 0, 0, 1, NULL, NULL, '2021-09-10 15:47:57', '2021-09-10 15:47:57', '2021-09-10 15:47:57', '2021-09-10 15:47:57', '2021-09-10 15:47:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votedAnswers`
--

DROP TABLE IF EXISTS `votedAnswers`;
CREATE TABLE `votedAnswers` (
  `id` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votedAReplies`
--

DROP TABLE IF EXISTS `votedAReplies`;
CREATE TABLE `votedAReplies` (
  `id` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `arid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votedQReplies`
--

DROP TABLE IF EXISTS `votedQReplies`;
CREATE TABLE `votedQReplies` (
  `id` int(11) NOT NULL,
  `qrid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votedQuestions`
--

DROP TABLE IF EXISTS `votedQuestions`;
CREATE TABLE `votedQuestions` (
  `id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `awardedBadges`
--
ALTER TABLE `awardedBadges`
  ADD UNIQUE KEY `awardId` (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `badgeId` (`badgeId`);

--
-- Chỉ mục cho bảng `awnserReplies`
--
ALTER TABLE `awnserReplies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `badges`
--
ALTER TABLE `badges`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `editedQuestionsList`
--
ALTER TABLE `editedQuestionsList`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notificationSchema`
--
ALTER TABLE `notificationSchema`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `questionsReplies`
--
ALTER TABLE `questionsReplies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reportedAnswers`
--
ALTER TABLE `reportedAnswers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reportedQuestions`
--
ALTER TABLE `reportedQuestions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reportSchema`
--
ALTER TABLE `reportSchema`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reputationRecord`
--
ALTER TABLE `reputationRecord`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `votedAnswers`
--
ALTER TABLE `votedAnswers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `votedAReplies`
--
ALTER TABLE `votedAReplies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `votedQReplies`
--
ALTER TABLE `votedQReplies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `votedQuestions`
--
ALTER TABLE `votedQuestions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `ads`
--
ALTER TABLE `ads`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `awardedBadges`
--
ALTER TABLE `awardedBadges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `awnserReplies`
--
ALTER TABLE `awnserReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `badges`
--
ALTER TABLE `badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT cho bảng `editedQuestionsList`
--
ALTER TABLE `editedQuestionsList`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `notificationSchema`
--
ALTER TABLE `notificationSchema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `questionsReplies`
--
ALTER TABLE `questionsReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reportedAnswers`
--
ALTER TABLE `reportedAnswers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reportedQuestions`
--
ALTER TABLE `reportedQuestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reportSchema`
--
ALTER TABLE `reportSchema`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `reputationRecord`
--
ALTER TABLE `reputationRecord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `votedAnswers`
--
ALTER TABLE `votedAnswers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `votedAReplies`
--
ALTER TABLE `votedAReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `votedQReplies`
--
ALTER TABLE `votedQReplies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `votedQuestions`
--
ALTER TABLE `votedQuestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
