try:
    a=int(input())
    for i in range(a):
        b=int(input())
        w=0
        for e in range(2,b):
            c=b%e
            if c==0:
                w=w+1
                break
        if w==0:
            print("Y")
        elif w>0:
            print("N")
except EOFError:
    pass
