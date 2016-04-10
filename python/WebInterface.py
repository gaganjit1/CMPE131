# Accepts response id as system argument

import Vector
import ConnectInfo
import sys

response_id = str(sys.argv[1])

db = ConnectInfo.sql()
cur = db[0]
conn = db[1]
sql = "select Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Q18, Q19, Q20 from User_Response where User_Response_ID="+response_id
answerssql=cur.execute(sql)
answers = cur.fetchall()

qanswers = map(int, answers[1:])
recommendation = Vector.distcheck(qanswers)
#print ("Your recommended major is: " + recommendation[0])
cur.execute("UPDATE User_Response SET Rec_Major = '" + recommendation[1] + "' WHERE User_Response_ID = " + response_id)