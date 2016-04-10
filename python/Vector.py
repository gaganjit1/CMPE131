import math
import SQL

def vectordist(a, b):
    c = []
    d = i = 0
    while i < len(a):
        x = a[i] - b[i]
        c.append(x)
        c[i] = c[i] * c[i]
        d = d + c[i]
        i += 1
    d = math.sqrt(d)

    return d

def distcheck(a):
    avg = SQL.getavg()

    cmpe = vectordist(a, avg[1])
    cheme = vectordist(a, avg[2])
    ee = vectordist(a, avg[3])
    meche = vectordist(a, avg[4])

    minm = min(cmpe, cheme, ee, meche)
    if  minm == cmpe:
        return "Computer Engineering", "CmpE"
    elif minm == cheme:
        return "Chemical Engineering", "ChemE"
    elif minm == ee:
        return "Electrical Engineering", "EE"

    return "Mechanical Engineering", "MechE"
