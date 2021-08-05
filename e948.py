try:
    a=int(input())
    while a>0:
        a=a-1
        b,c,d,e=input().split()
        b=int(b)
        c=int(c)
        d=int(d)
        e=int(e)
        if b==1:
            qwe=(13.7*e)+(5.0*d)-(6.8*c)+66
            print('%.2f'%qwe)
        elif b==0:
            qwe=(9.6*e)+(1.8*d)-(4.7*c)+655
            print('%.2f'%qwe)
except EOFError:
    pass
