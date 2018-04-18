#include<stdio.h>
#include<conio.h>
#include<iostream >
#include<math.h> 
#define MAX_SIZE 100
using namespace std;
// THEM DA THUC, SAP XEP, TIM KIEM DA THUC
   	struct  poly{
   	float coef[100]; //he so
   	int expon[100];  //so mu~
   	int size;
   	};

void create (poly & p){ //ham tao
	p.size = 0;
}
poly add(int a, float b, poly &p){ // Ham them *So mu~ + he So*
	p.coef[p.size]=a;   // he so = a *Gan gia tri vao a*
	p.expon[p.size]=b; // So mu = b *Gan gia tri vao b*
	p.size ++; //Cong them 1 donvi
	return p;
}
 void show(poly p){ // In ra man hinh
 	for (int i=0;i<p.size;i++){ //Vong lap --
 		if (p.coef[i]<0) cout <<" - "; //Neu Heso[i] < 0 ==> No se - 1 donvi
 		else cout <<"  +  "; //Else +
 		cout <<abs(p.coef[i])<<"x^"<<p.expon[i]; // Xac dinh dau truoc he so, 
	 }
	 cout<<endl; //xuong dong
 }
 void sort (poly &p){
 	for (int i=0; i<p.size-1;i++){
 		for (int j=i+1;j<p.size;j++){
 			if (p.expon[i]<p.expon[j])
 			{
		 		float t= p.coef[i];
		 		p.coef[i]=p.coef[j];
		 		p.coef[j]=t;
		 		int m = p.expon[i];
		 		p.expon[i]=p.expon[j];
		 		p.expon[j] = m;
			 }
		}
	}
 }
 int search(int e , poly p) //TIM KIEM
 {
 int i=0;
 while ((p.expon[i]!=e)&&(i<p.size))
   i++;
 if(i>=p.size) return -1;
 else return i;
}
  int main(){
  	poly p;
  	create (p);
  	add(3,2,p); //THEM GIA TRI VAO DA THUC (3-->he so | 2 so mu~ | p)
  	add(4,5,p);
  	add(6,2,p);
  	show (p); 
  	sort(p);
  	show(p);
  	int k = search(5,p); // Chi tim so mu~
  	if (k==-1)
  	cout <<"khong tim thay";
  	else {
  		cout<<"tim thay:"<<p.coef[k]<<"x^"<<p.expon[k];
	  }
  }
