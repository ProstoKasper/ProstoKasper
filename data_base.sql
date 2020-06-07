
CREATE TABLE `uploaded_text` (
  `ID` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `words_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `word` (
  `ID` int(11) NOT NULL,
  `text_id` int(11) DEFAULT NULL,
  `word` text COLLATE utf8mb4_unicode_ci,
  `word_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

ALTER TABLE `uploaded_text`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `word`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `uploaded_text`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `word`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=796;
COMMIT;

