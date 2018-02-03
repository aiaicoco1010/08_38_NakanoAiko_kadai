UPDATE gs_an_table SET
name = 'TEST1', email='test@test.jp', naiyou='内容' WHERE id=6

UPDATE gs_an_table SET
name = :name, email = :email, naiyou=:naiyou WHERE id=6


DELETE FROM gs_an_table WHER id=:id