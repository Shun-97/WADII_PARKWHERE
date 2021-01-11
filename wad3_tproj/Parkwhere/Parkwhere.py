import telebot
import time
import MySQLdb
from apscheduler.schedulers.background import BackgroundScheduler


bot_token = "1426749808:AAFqLh_CAqmdoHdphpUnUPlPN1bV1v-qh6E"

bot = telebot.TeleBot(token=bot_token)

db = MySQLdb.connect(host="127.0.0.1",    # localhost
                     user="root",  # username
                     passwd="",  # password
                     db="parkwhere")        # name of the data base


# Uilities
scheduler = BackgroundScheduler()
scheduler.start()


def preparation_message(name, chatid):
    message2 = f'Hello {name}! Please start leaving now!'
    bot.send_message(chatid, message2)


# def check

# COMMANDS PROMPTS


@bot.message_handler(commands=['start'])
def send_welcome(message):
    bot.reply_to(message, 'Thank you for using Parkwhere!\n'
                 'Please type your Schedule ID provided by the webite')

    # MESSAGE PROMPTS


@bot.message_handler(func=lambda msg: msg.text is not None and not msg.text.isnumeric())
def Error(message):
    bot.reply_to(
        message, 'Please only input numbers to start your scheduling')


@bot.message_handler(func=lambda msg: msg.text is not None and msg.text.isnumeric())
def Notification(message):
    cur = db.cursor()
    cur.execute("SELECT  * FROM schedule where ID = %s", [message.text])
    output = cur.fetchall()
    if len(output) == 0:
        bot.reply_to(
            message, 'No schedule detected. Please check and re-enter the correct number')
    else:
        name = output[0][1]
        time = output[0][3]
        location = output[0][2]
        user_id = message.from_user.id
        bot.reply_to(
            message, f"Hello {name}! Reminder to leave for {location} at {time} has been set!")

        scheduler.add_job(preparation_message, 'date',
                          run_date=time, args=[name, user_id])

        cur = db.cursor()
        cur.execute("DELETE FROM schedule where ID = %s", [message.text])


try:
    bot.polling(none_stop=True)
except:
    time.sleep(10)
