select *
from node
where type = 'delivery'
    and MONTH(FROM_UNIXTIME(created)) = 10
    and title like '8046%';