select users.name, users.mail, node.*
from users
    inner join node on users.uid = node.uid
where users.name = 'serhiy'
limit 20;