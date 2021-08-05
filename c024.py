try:
    while 1:
        a=int(input())
        if a<=-1:
            break
        print(1+(a*(a+1))//2)
except:
    EOFError
