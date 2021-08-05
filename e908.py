qwe=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
a=input()
p=0
for i in qwe:
    if i==a:
        b=int(input())
        b=(p+b)
        b=b%7
        print(qwe[b])
    p=p+1
