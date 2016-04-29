from ConnectInfo import *
import Vector

def storeresponse(answers):
    answersstr = "', '".join(answers)


    db = sql()
    cur = db[0]
    conn = db[1]
    #conn = sql()[1]
    #cur = sql()[0]

    print "***************************"
    query = "INSERT INTO sjsu.User_Response (SJSU_ID, Q1, Q2, Q3, Q4, Q5, Q6, Q7, Q8, Q9, Q10, Q11, Q12, Q13, Q14, Q15, Q16, Q17, Q18, Q19, Q20, Major) VALUES('" + answersstr + "', NULL)"
    print query
    cur.execute(query)
    print "***************************"
    last_id = str(cur.lastrowid)
    print "***************************"
    print "Your User Response ID is " + last_id +"."
    #cur.commit()

    # Seperate function?
    qanswers = map(int,answers[1:])
    recommendation = Vector.distcheck(qanswers)
    print ("Your recommended major is: " + recommendation[0])
    cur.execute("UPDATE User_Response SET Rec_Major = '" + recommendation[1] + "' WHERE User_Response_ID = " + last_id)
    #cur.commit()

# mssql
#def getavg():
#    cur = sql()[0]
#    cur.execute("SELECT AVG(Q1), AVG(Q2), AVG(Q3), AVG(Q4), AVG(Q5), AVG(Q6), AVG(Q7), AVG(Q8), AVG(Q9), AVG(Q10), AVG(Q11), AVG(Q12),  AVG(Q13), AVG(Q14), AVG(Q15), AVG(Q16), AVG(Q17), AVG(Q18), AVG(Q19), AVG(Q20) FROM [Class].[dbo].[User_Response] GROUP BY Engineer")
#    row = cur.fetchall()
#    return list(row)

# mysql
def getavg():
    cur = sql()[0]
    cur.execute("SELECT AVG(Q1), AVG(Q2), AVG(Q3), AVG(Q4), AVG(Q5), AVG(Q6), AVG(Q7), AVG(Q8), AVG(Q9), AVG(Q10), AVG(Q11), AVG(Q12),  AVG(Q13), AVG(Q14), AVG(Q15), AVG(Q16), AVG(Q17), AVG(Q18), AVG(Q19), AVG(Q20) FROM User_Response GROUP BY Major;")
    row = cur.fetchall()
    return list(row)

def pullexisting(id):

    cur = sql()[0]
    cur.execute("Select * from User_Response where User_Response_ID =" + id)
    row = cur.fetchall()

    new = [str(i[0]) for i in row]

    if str(new[0]) != "0":
        print "Welcome back " + str(new[0]) + "!"
        return 0
    else:
        print "No such ID exists."
        return 1



