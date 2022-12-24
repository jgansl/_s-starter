import pyperclip

def doItForMe(
   fl=160 ,
   fs=80 , 
   sl=1400 ,
   ss=375 ,
   prop ='font-size'
):
   e = (fl - fs) / (sl - ss)
   b = fl - (e * sl)# / 100)
   vw = e * 100
   fin = f"@include clamp({prop}, {fs}px, calc({vw}vw + {b}px), {fl}px);"
   print(e, b, vw)
   print()
   print(fin)
   pyperclip.copy(fin)
   val = pyperclip.paste()
   return
doItForMe(
   prop = 'padding-top'
)