try:
    input()
    qwe=[]
    asd=[]
    qwe=map(int,input().split())
    for i in qwe:
        p=len(str(i))
        c=0
        while 1:
            p=p-1
            c=((i%10)*(10**p))+c
            i=i//10
            if i==0:
                asd.append(c)
                break
    asd.sort()
    print(asd[-1])
except:
    EOFError
