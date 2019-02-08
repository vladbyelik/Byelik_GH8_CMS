SELECT *
FROM node
WHERE TYPE = 'delivery'
    AND MONTH(FROM_UNIXTIME(created)) = 10
    AND title LIKE '8046%';