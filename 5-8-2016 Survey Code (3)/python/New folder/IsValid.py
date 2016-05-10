def questionsdict(i):
    questiondict = {1: 'Would you like to design computers?',
                    2: 'Do you like programming in your spare time?',
                    3: 'Are you interested in computer hardware?',
                    4: 'Are you able to quickly recognize patterns?',
                    5: 'Do you like talking and learning about how computers and electronics work?',
                    6: 'Do you like the idea of performing alchemy?',
                    7: 'Are you interested in the chemical manufacturing process?',
                    8: 'Do you like the periodic table?',
                    9: 'Do you like chemistry?',
                   10: 'Are you interested in creating new materials?',
                   11: 'Would you like to learn more about circuit boards and electronic equipment?',
                   12: 'Would you be interested in signal processing?',
                   13: 'Are you interested in designing more energy-efficient or powerful electronic devices?',
                   14: 'Are you interested in Power Electronics?',
                   15: 'Do you enjoy tinkering on projects and or creating your own electrical devices?',
                   16: 'Do you like taking things a part and reassembling them?',
                   17: 'Are you interested in creating 3D models?',
                   18: 'Are you comfortable and confident in Geometry and Trigonometry?',
                   19: 'Are you interested with the mechanical generation, distribution, and use of energy?',
                   20: 'Do you like building mechanical parts and think about how you can improve them?'}

    return questiondict[i]



def answer(string):
    if string.lower() in ('100', '75', '50', '25', '0'):
        return 1
    else:
        return 0



def newold(string):
    if string.lower() in ('survey'):
        return 2
    elif string.lower() in ('returning', 'returning back'):
        return 1
    else:
        return 0

