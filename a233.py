try:
    input()
    qwe=[]
    qwe=map(int,input().split())
    qwe=sorted(qwe)
    for i in qwe:
        print(i,"",end="")
except:
    EOFError
