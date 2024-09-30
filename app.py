from flask import Flask, render_template, request, redirect, url_for
import mysql.connector

app = Flask(__name__)

# MySQL database connection
db = mysql.connector.connect(
    host="localhost",
    user="root",   # Replace with your MySQL username
    password="your_password",   # Replace with your MySQL password
    database="e_library_db"  # Replace with your database name
)

# Route for home
@app.route('/add-book', methods=['GET', 'POST'])
def add_book():
    if request.method == 'POST':
        title = request.form['title']
        author = request.form['author']
        isbn = request.form['isbn']
        year_published = request.form['year_published']

        # Insert into MySQL database
        cursor = db.cursor()
        cursor.execute("INSERT INTO books (title, author, isbn, year_published) VALUES (%s, %s, %s, %s)",
                       (title, author, isbn, year_published))
        db.commit()

        return redirect(url_for('home'))

    return render_template('add-book.html')
