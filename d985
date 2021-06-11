try:
    for i in range(int(input())):
        p=0
        qwe=[]
        for ii in range(int(input())):
            n=ii
            a,b=map(int,input().split())
            p+=b+(a*60)
            qwe.append(b+(a*60))
        qwe=sorted(qwe)
        print("Track ",i+1,":",sep="")
        print("Best Lap:",qwe[0]//60,"minute(s)",qwe[0]%60,"second(s).")
        print("Average:",p//(n+1)//60,"minute(s)",p//(n+1)%60,"second(s).")
except:
    EOFError
