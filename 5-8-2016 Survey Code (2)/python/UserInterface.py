import IsValid
import SQL


class UserQuestions:

   def __init__ (self):
       self.answers = [None] * 21
       self.neworold()

   def neworold(self):
       user = raw_input('Want to take a survey, or are you just returning? ')
       if IsValid.newold(user) == 2:
            self.askname()
       elif IsValid.newold(user) == 1:
            self.pulluser()
       else:
            print "Error!"
            self.neworold()

   def pulluser(self):
       user = raw_input('What was your User ID? ')
       if SQL.pullexisting(user) == 1:
           self.neworold()


   def askname(self):
       self.answers[0] = raw_input( 'What is your SJSU_ID? ')
       self.questioning()


   def questioning(self):
       i = 1
       while i <= 20:
           user = raw_input(IsValid.questionsdict(i) + " ")
           self.answers[i] = user
           i += 1
       SQL.storeresponse(self.answers)
       self.neworold()



UserQuestions()

