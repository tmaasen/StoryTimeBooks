/*
Query the two cities in STATION with the shortest and longest CITY names, as well as their respective lengths (i.e.: number of characters in the name). If there is more than one smallest or largest city, choose the one that comes first when ordered alphabetically.
*/
SELECT
    city,
    CHAR_LENGTH(city)
FROM STATION
WHERE city = (
    SELECT
        MIN(city)
    FROM STATION
    WHERE CHAR_LENGTH(city) = (
        SELECT
            MIN(CHAR_LENGTH(city))
        FROM STATION
    )
)
OR city = (
    SELECT
        MIN(city)
    FROM STATION
    WHERE CHAR_LENGTH(city) = (
        SELECT
            MAX(CHAR_LENGTH(city))
        FROM STATION
    )
);