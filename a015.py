try:
    while 1:
        qwe=[]
        a,b=map(int,input().split())
        for i in range(a):
            qwe.append(input().split())
        for u in range(b):
            for i in range(a):
                print(qwe[i][u],"",end="")
            print()
except:
    EOFError
