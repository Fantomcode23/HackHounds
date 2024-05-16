import sqlite3
con=sqlite3.connect('hospitaldata.sqlite')
cursor = con.cursor()

cursor.execute('''
CREATE TABLE if not exists records (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    blood_group TEXT NOT NULL,
    year_ofbirth INTEGER
)
''')

patient_data = [
    ("Sumit Randhawa", "O+", 1974),
    ("Aradhya Kashyap", "B+", 1988),
    ("Kunal Banerjee", "A+", 1992)
]

cursor.executemany('''
INSERT INTO books (name, blood_group, year_ofbirth) VALUES (?, ?, ?)
''', patient_data)

con.commit()
