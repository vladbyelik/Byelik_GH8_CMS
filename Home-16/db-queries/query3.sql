SELECT users.name, users.mail, node.*
FROM users
    INNER JOIN node ON users.uid = node.uid
WHERE users.name = 'serhiy'
limit 20;